<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');
App::import('Vendor', 'opengraph/OpenGraph');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class RssesController extends AppController {
    public $components = array('Search.Prg', 'Session', 'Master');
    public $uses = array('Rss','Profession', 'Image', 'Movie' ,'CheckLike', 'CheckPersonal', 'Job', 'Advertisement');
    public $paginate = array();
    public function index()
    {
        $data = $this->Rss->find('all',array(
            'conditions' => array(
              'Rss.delete_flag' => 0
            ),
           'order' => array(
                'created' => 'DESC',
            ),
        ));

        $advertisement = $this->Advertisement->find('all',array(
            'conditions' => array(
              'Advertisement.delete_flag' => 0,
              'Advertisement.display_flag' => 1,
            ),
           'order' => array(
                'created' => 'DESC',
            ),
        ));
        foreach ($data as $key => $value) {
            //1はrss
            if ($value['Rss']['rss_flag'] == 1) {
                $rss_urls[$key] = $value['Rss']['url'];
            } else {
                $pickup_urls[$key]['title'] = $value['Rss']['title'];
                $pickup_urls[$key]['url'] = $value['Rss']['url'];
                $pickup_urls[$key]['image'] = $value['Rss']['img_url'];
                $pickup_urls[$key]['description'] = $value['Rss']['description'];
            }
        }
        $rss_urls = array_merge($rss_urls);
        $pickup_urls = array_merge($pickup_urls);

        $datas = $this->_get_rss($rss_urls, $pickup_urls, $advertisement);
        $this->set('title_for_layout', '転職ニュースまとめ');
        $datas['Profession']['job_content'] = $datas['rss'][0]['description'];
        if(!$datas) return false;
        $this->_getSideContent();
        $this->set(compact('datas'));
    }

    public function _get_rss($rss_urls, $pickup_urls, $advertisement)
    {
        $openGraph = new OpenGraph();
        for ($i = 0; $i < count($rss_urls); $i++){
            $rss = Xml::build($rss_urls[$i]);
            //まいなび
            if($rss->item){
                for ($n=0; $n<2; $n++){
                    $url = $rss->item[$n]->link;
                    $graph = $openGraph->fetch($url);
                    $rss_infos[$i][$n]['image'] = $graph->image;
                    $rss_infos[$i][$n]['title'] = mb_strimwidth($rss->item[$n]->title, 0 , 500, "", "utf-8");
                    $rss_infos[$i][$n]['link'] = mb_strimwidth($rss->item[$n]->link, 0 , 500, "", "utf-8");
                    $rss_infos[$i][$n]['description'] = mb_strimwidth (strip_tags($rss->item[$n]->description), 0 , 500, "", "utf-8");
                }
            } elseif ($rss->channel->item) {
                $n = 0;
                foreach ($rss->channel->item as $item) {
                    $url = $item->link;
                    $graph = $openGraph->fetch($url);
                    $rss_infos[$i][$n]['image'] = $graph->image;
                    $rss_infos[$i][$n]['title'] = mb_strimwidth($item->title, 0 , 65, "...", "utf-8");
                    $rss_infos[$i][$n]['link'] = mb_strimwidth($item->link, 0 , 500, "", "utf-8");
                    $rss_infos[$i][$n]['description'] = mb_strimwidth (strip_tags($item->description), 0 , 500, "", "utf-8");
                    //$rss_infos[$i][$n]['date'] = mb_strimwidth (strip_tags(date("Y-m-d H:i:s", strtotime($item->pubDate))), 0 , 100, "", "utf-8");
                    if ($n > 1) {
                        break;
                    }
                    $n++;
                }
            }
        }
        $rss_infos = Hash::extract($rss_infos, '{n}.{n}');
        //ピックアップの記事
        for ($i = 0; $i < count($pickup_urls); $i++){
            if (!empty($graph->image)) {
                $pickup_url[$i]['title'] = $pickup_urls[$i]['title'];
                $pickup_url[$i]['url'] = $pickup_urls[$i]['url'];
                $pickup_url[$i]['image'] = $pickup_urls[$i]['image'];
                $pickup_url[$i]['description'] = $pickup_urls[$i]['description'];
            }
        }
        foreach ($advertisement as $key => $value) {
            if ($key == 0) {
                $ad_url_1[0]['title'] = $value['Advertisement']['text_url'];
                $ad_url_1[0]['image'] = $value['Image'][0]['url'];
                $ad_url_1[0]['advertisement'] = 1;
            } elseif($key == 1) {
                $ad_url_2[0]['title'] = $value['Advertisement']['text_url'];
                $ad_url_2[0]['image'] = $value['Image'][0]['url'];
                $ad_url_2[0]['advertisement'] = 1;
            }
        }
        //RSSの記事
        // foreach ($rss_infos as $key => $rss_info) {
        //     $url = $rss_info['link'];
        //     $graph = $openGraph->fetch($url);
        //     $rss_infos[$key]['image'] = $graph->image;
        // }

        array_splice($pickup_url, 3, 0, $ad_url_2);
        array_splice($pickup_url, 8, 0, $ad_url_1);

        $datas['rss'] = $rss_infos;
        $datas['pickup'] = $pickup_url;

        return $datas;
    }

    public function admin_index() {
            $this->layout = "default";
            $this->Prg->commonProcess();
            //$this->paginate['conditions'] = $this->CheckLike->parseCriteria($this->passedArgs);

            $this->paginate = array(
                    'conditions' => array(
                             'Rss.delete_flag' => '0'
                     ),
                    'order' => array(
                            'Rss.created' => 'DESC',
                    ),
                    'limit' => '15'
            );
            $datas = $this->paginate();
        $this->set('datas',$datas);
     }

    public function admin_add() {

        echo pr($this->request->data);
        
        
        
      $openGraph = new OpenGraph();
      $this->layout = "default";
      //$this->_getCheckGenre();
      if ($this->request->is(array('post', 'put'))) {
         if ($this->request->data['Rss']['rss_flag'] == 0) {
            $url = $this->request->data['Rss']['url'];
            $graph = $openGraph->fetch($url);
            if (!empty($graph->image)) {
                $this->request->data['Rss']['title'] = mb_strimwidth($graph->title, 0 , 65, "...", "utf-8");
                $this->request->data['Rss']['url'] = $graph->url;
                $this->request->data['Rss']['img_url'] = $graph->image;
                $this->request->data['Rss']['description'] = $graph->description;
            } else {
                $rssdata = get_meta_tags($pickup_urls[$i]);
                $this->request->data = $rssdata;
            }
         }
         
         if ($this->Rss->save($this->request->data)) {
          return $this->redirect(
            array('controller' => 'Rsses', 'action' => 'admin_index')
          );
        } else {
          return false;
        }
      }
    }

    public function admin_edit($id = null) {
        $this->layout = "default";
      if ($this->request->is(array('post', 'put'))) {

          $status = array(
            'Rss.title' => '"'.$this->request->data['Rss']['title'].'"',
            'Rss.url' => '"'.$this->request->data['Rss']['url'].'"',
            'Rss.rss_flag' => $this->request->data['Rss']['rss_flag'],
          );
          $conditions = array(
            'Rss.id' => $this->request->data['Rss']['id'],
          );
          $this->Rss->updateAll($status, $conditions);
          return $this->redirect(
            array('controller' => 'Rsses', 'action' => 'admin_index')
          );
      } else {
        $this->request->data = $this->Rss->find('first',array(
            'conditions' => array(
              'Rss.id' => $id
            ),
        ));
      }
    }

    /**/
    /*削除箇所
    /*
    /*
    /*
    /*
    /*
    /**/
    public function admin_delete($id = null){
        $this->layout = "default";
        $status = array(
          'delete_flag' => 1,
        );
        $conditions = array(
          'Rss.id' => $id,
        );
        $this->Rss->updateAll($status, $conditions);
        return $this->redirect( array('controller' => 'Rsses', 'action' => 'admin_index'));
    }

    public function _getCheckGenre() {
        $like_genre = $this->Master->getlikeGenre();
        $this->set(compact("like_genre"));
    }

    public function _getSideContent($datas = null) {
        $datas = array('123','127','129','136','142');
        $status = array(
                'fields' => array(
                        'Profession.id', 'Profession.profession_name', 'job_salary', 'personality'
                ),
                'conditions' =>
                array(
                        'Profession.id' => $datas,
                        'delete_flag' => 0
                ),
                'recursive'  => -1
                );
            $related = $this->Profession->find('all', $status);

            $status = array(
            'conditions' => array(
                    'image_flag' => '1'
            ),
            'order' => array(
                    'core_status' => 'DESC',
            ),
            'limit' => 6,
            );
            // 以下がデータベース関係
            $core_content = $this->Profession->find('all', $status);
            shuffle($core_content);
            $this->set(compact("related", "core_content"));
    }

        
        

}
