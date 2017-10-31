<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright Blog.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class BlogsController extends AppController {
	public $uses = array('Blog', 'Image', 'Rss', 'Home');
	public $components = array('Search.Prg', 'Session', 'Master');
	public $presetVars = true;
	public $paginate = array();


	public function index() {
		$this->paginate = array(
			'limit' => 5,
		);
		$this->Prg->commonProcess();
                $this->paginate['conditions'] = $this->Blog->parseCriteria($this->passedArgs);
		if (empty($this->request->data)) {
			// 初期表示時
			$this->paginate = array(
				'conditions' => array(
				   'release_flag' => '1',
                                   'delete_flag' => '0',
				 ),
				'order' => array(
					'modified' => 'DESC',
				),
			);
		} else {
			$this->paginate['conditions']['Blog.delete_flag'] = '0';
		}
		$datas = $this->paginate();
                $this->_getParameter();
		$this->set('datas',$datas);
	}





public function detail($id = null, $first = null) {
	//exit();
	//echo pr($id);
	// レイアウト関係
	$this->layout = "default";
	if (isset($id)) {
		$status = array(
		'conditions' =>
			array(
				'Blog.id' => $id,
				'Blog.delete_flag' => 0
			)
		);
		// 以下がデータベース関係
		$datas = $this->Blog->find('first', $status);
	//echo pr($datas);
	//exit();
		if (!empty($datas['Blog']['image_flag'])) {
			$id = $datas['Blog']['id'];
			$status = array(
				'conditions' =>
				array(
					'partner_id' => $id,
					'partner_name' => 'Blog',
					'delete_flag' => '0'
				)
			);
			$datas['Image'] = $this->Image->find('all', $status);
		}
		$this->set('title_for_layout', $datas['Blog']['title']);
		$datas['title'] = $datas['Blog']['title'];
		$this->_getParameter();
		$this->set(compact('datas'));
	}
}

/**
 * star method
 * お気に入りを追加/削除する
 *
 * @throws NotFoundException
 * @return void
 */
	public function know_count() {
		if (!$this->request->is('ajax')) {
			throw new NotFoundException('お探しのページは見つかりませんでした。');
		}
		$this->autoRender = false;
		$data = array();
		$data['id'] =  $this->request->data['Blog']['id'];
		$data['class'] = $this->request->data['Blog']['class'];
			$knowCount = $this->Blog->find('first', array(
				'fields' => array(
					'Blog.know_count',
				),
				'conditions' => array(
					'Blog.id' => $data['id'],
				),
				'recursive'  => -1
			));
			if ($this->request->data['Blog']['class'] == 'know_count plus') {
	        $action = 'plus';
					$data['Blog']['know_count'] = $knowCount['Blog']['know_count'] + 1;
			} else {
	      	$action = 'minus';
					$data['Blog']['know_count'] = $knowCount['Blog']['know_count'] - 1;
			}
			$this->Blog->updateAll(
				array(
					'Blog.modified' => "'" . date('Y-m-d H:i:s') . "'",
					'Blog.know_count' => $data['Blog']['know_count'],
				),
				array(
					'Blog.id' => $data['id'],
				)
			);
			$status = true;
		$data['action'] = $action;
		$data['status'] = $status;
		echo json_encode($data);
	}

	public function write_post() {
		$this->log($this->request->data, LOG_DEBUG);
		if (!$this->request->is('ajax')) {
		  throw new NotFoundException('お探しのページは見つかりませんでした。');
		}
		$this->autoRender = false;
		$data = array();
		$data['blog_id'] =  $this->request->data['wirte_down']['blog_id'];
		$data['write_name'] = $this->request->data['wirte_down']['write_name'];
		$data['write_text'] = $this->request->data['wirte_down']['write_text'];
		$data['up_flag'] = $this->request->data['wirte_down']['up_flag'];

		if (!$this->WriteDown->save($data)) {
			 $status = flase;
		} else {
			$aaa = $this->WriteDown('sql_dump');
					$this->log($aaa, LOG_DEBUG);
			 $status = true;
		}
		$this->log($this->element('sql_dump'), LOG_DEBUG);
		echo json_encode($status);
	}




  public function admin_index() {
		$this->layout = 'default';
		$this->paginate = array(
			'limit' => 5,
		);
		$this->Prg->commonProcess();
                $this->paginate['conditions'] = $this->Blog->parseCriteria($this->passedArgs);
		if (empty($this->request->data)) {
			// 初期表示時
			$this->paginate = array(
				'conditions' => array(
				   'delete_flag' => '0'
				 ),
				'order' => array(
					'modified' => 'DESC',
				),
			);
		} else {
			$this->paginate['conditions']['Blog.delete_flag'] = '0';
		}
		$datas = $this->paginate();
		$this->set('datas',$datas);
  }

/**/
/*登録箇所
/*
/*
/*
/*
/*
/**/
  public function admin_add() {
    $this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
        //画像処理
      foreach ($this->request->data['Image'] as $key => $value) {
          if ($value['error'] == 4) {
            unset($this->request->data['Image'][$key]);
          }
      }

      if ($this->Session->read('image')) {
        $Image = $this->Session->read('image');
        $count = count($this->request->data['Image']);
        if ($count == 0) {
          $this->request->data['Image'] = $Image;
        } else {
          $countkey = $count - 1;
          foreach ($this->request->data['Image'] as $key => $phots) {
            if ($key == $countkey) {
              foreach ($Image as $key => $value) {
                $this->request->data['Image'][$count] = $value;
                $count++;
              }
            }
          }
        }
        $this->Session->delete('image');
      }
      // 仮アップロード
      $now = date("YmdHis");
      $finfo = finfo_open(FILEINFO_MIME_TYPE);

      foreach($this->request->data['Image'] as $key => $val){
        if(!$val["tmp_name"]) continue;
        if(!empty($val["url"])) continue;
        $files[$key]["name"] = $val["name"];
        // アップロードされたファイルが画像かどうかチェック
        list($mime,$ext) = explode("/",finfo_file($finfo, $val["tmp_name"]));
        if($mime!="image") $err[] = "ファイル{$key} は画像を選択してください";
        if($mime!="image") unset($files[$key]);
				if($mime!="image") continue;
        copy($val["tmp_name"],"files/updir/tmp/" . "{$now}_{$key}.{$ext}");
        $this->request->data['Image'][$key]["tmp_name"] = "{$now}_{$key}.{$ext}";
        $this->request->data['Image'][$key]["url"] = "/files/updir/tmp/" ."{$now}_{$key}.{$ext}";
      }
      finfo_close($finfo);



      $this->Blog->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Blog->validates()) {
        //画像削除
        if (!empty($this->request->data['Check'])) {
          foreach ($this->request->data['Check'] as $key => $Checkd) {
            if ($Checkd['photo'] != '0') {
              foreach ($this->request->data['Image'] as $key => $Images) {
                if ($Images['url'] == $Checkd['photo']) {
                    unset($this->request->data['Image'][$key]);
                }
              }
            }
          }
          if (empty($this->request->data['Image'][0]["name"])) {
            unset($this->request->data['Image'][0]);
          }
          $this->request->data['Image'] = array_merge($this->request->data['Image']);
        }
//echo pr($this->request->data);
//exit();

        $this->set('data', $this->request->data);
        $this->render('/Blogs/admin_confirm');

      } else {

        if (!empty($this->request->data['Check'])) {
          foreach ($this->request->data['Check'] as $key => $Checkd) {
            if ($Checkd['photo'] != '0') {
              foreach ($this->request->data['Image'] as $key => $Images) {
                if ($Images['url'] == $Checkd['photo']) {
                    unset($this->request->data['Image'][$key]);
                }
              }
            }
          }
          if (empty($this->request->data['Image'][0]["name"])) {
            unset($this->request->data['Image'][0]);
          }
          $this->request->data['Image'] = array_merge($this->request->data['Image']);
        }
        //バリデーションエラーで画像セッションに保存
        $this->Session->write('image', $this->request->data['Image']);
        return false;
      }
    }
  }

  /**/
  /*登録DBに登録箇所
  /*
  /*
  /*
  /*
  /*
  /**/

  public function admin_regist() {
    $this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
    //戻るボタン
    if (isset($this->request->data['back'])) {
        //バリデーションエラーで画像/動画をセッションに保存
        if (!empty($this->request->data['Image'])) {
            $this->Session->write('image', $this->request->data['Image']);
        }
        $this->render('/Blogs/admin_add');
    } elseif (isset($this->request->data['regist'])) {
        $data = $this->request->data;

        if (!empty($data['Image'])) {
          $data['Blog']['image_flag'] = 1;
          foreach ($data['Image'] as $key => $value) {
            $data['Image'][$key]['partner_name'] = 'Blog';
          }
        }
        $this->Blog->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Blog->validates()) {
          $this->Blog->save($data['Blog']);
            $partner_id = $this->Blog->getLastInsertID();


            if (!empty($data['Image'])) {
            foreach($data['Image'] as $key => $val){
                $cut = 1;//カットしたい文字数
                $val["url"] = substr( $val["url"] , $cut , strlen($val["url"])-$cut );
                $file = new File(WWW_ROOT.$val["url"]);
                $file->copy(WWW_ROOT."/files/updir/" . $val["tmp_name"],true);
                $file = new File(WWW_ROOT.$val["url"]);
                $file->delete();
                $data['Image'][$key]["url"] = "/files/updir/" . $val["tmp_name"];
                $data['Image'][$key]["partner_id"] = $partner_id;
            }
              foreach ($data['Image'] as $key => $value) {
                $this->Image->create(false);
                $this->Image->save($value);
              }
            }

          return $this->redirect(
            array('controller' => 'Blogs', 'action' => 'admin_index')
          );
        } else {

          $this->set('data',$data);
          $this->render('/Blogs/admin_add');
        }
      }
    }
  }

/**/
/*編集箇所
/*
/*
/*
/*
/*
/**/
public function admin_edit($id = null){
	// レイアウト関係
	$this->layout = "default";
	//変更処理
  if ($this->request->is(array('post', 'put'))) {
		//画像がエラーの物削除
    foreach ($this->request->data['Image'] as $key => $value) {
        if ($value['error'] == 4) {
          unset($this->request->data['Image'][$key]);
        }
    }
    $this->request->data['Image'] = array_merge($this->request->data['Image']);
		//画像セッション読み込み
    if ($this->request->data['Blog']['BeforeImage']) {
      $count = count($this->request->data['Image']);
			//追加なければセッションの値そのまま入れる
      if ($count == 0) {
        $this->request->data['Image'] = $this->request->data['Blog']['BeforeImage'];
      } else {
        $countkey = $count - 1;
        foreach ($this->request->data['Image'] as $key => $phots) {
          if ($key == $countkey) {
            foreach ($this->request->data['Blog']['BeforeImage'] as $key => $value) {
              $this->request->data['Image'][$count] = $value;
              $count++;
            }
          }
        }
      }
			//セッション削除
      $this->Session->delete('image');
    }


		$image = $this->Session->read('image');
		//空のデータが入ってくるので削除


    $now = date("YmdHis");
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

		// exit();

    // 仮アップロード
    foreach($this->request->data['Image'] as $key => $val){
        if(empty($val["tmp_name"])) continue;
        if(!empty($val["url"])) continue;
        $files[$key]["name"] = $val["name"];
        // アップロードされたファイルが画像かどうかチェック
        list($mime,$ext) = explode("/",finfo_file($finfo, $val["tmp_name"]));
        if($mime!="image") $err[] = "ファイル{$key} は画像を選択してください";
        if($mime!="image") unset($files[$key]);
        if($mime!="image") continue;
        // 仮ディレクトリへファイルをアップロード
        copy($val["tmp_name"],"files/updir/tmp/" . "{$now}_{$key}.{$ext}");
        $this->request->data['Image'][$key]["tmp_name"] = "{$now}_{$key}.{$ext}";
				$this->request->data['Image'][$key]["url"] = "/files/updir/tmp/" ."{$now}_{$key}.{$ext}";
      }
      finfo_close($finfo);


      $this->Blog->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Blog->validates()) {
        //画像削除チェックの入ったものを削除
        if (!empty($this->request->data['Check'])) {
          foreach ($this->request->data['Check'] as $key => $Checkd) {
            if ($Checkd['photo'] != '0') {
              foreach ($this->request->data['Image'] as $key => $Images) {
                if ($Images['url'] == $Checkd['photo']) {
                    unset($this->request->data['Image'][$key]);
                }
              }
            }
          }
          if (empty($this->request->data['Image'][0]["url"])) {
            unset($this->request->data['Image'][0]);
          }
        }
        $this->request->data['Image'] = array_merge($this->request->data['Image']);



			//最初に削除していて一回「戻るボタン」して再度「確認」押下時に必要処理
			//再度削除処理にセットしている
      if (!empty($this->request->data['photo_dele'])) {
        if (!empty($this->request->data['Check'])) {
          $checkcount = count($this->request->data['Check']);
          foreach ($this->request->data['Check'] as $key => $CheckPhoto) {
              foreach ($this->request->data['photo_dele'] as $key => $photo_dele) {
                if ($photo_dele != '0') {
                  $this->request->data['Check'][$checkcount + $key]['photo'] = $photo_dele;
                }
              }
          }
        } elseif (!empty($this->request->data['photo_dele'])) {
          foreach ($this->request->data['photo_dele'] as $key => $photo_dele) {
            $this->request->data['Check'][$key]['photo']  = $photo_dele;
          }
        }
      }


      if (!empty($this->request->data['photo_dele'])) {
        $this->request->data['Check'] = array_unique($this->request->data['Check']);
        $this->request->data['Check'] = array_merge($this->request->data['Check']);
        $this->request->data['photo_dele'] = array_unique($this->request->data['photo_dele']);
        $this->request->data['photo_dele'] = array_merge($this->request->data['photo_dele']);
      }

        //画像/動画をセッションに保存
        $this->Session->write('Image', $this->request->data['Image']);
        $this->set('data',$this->request->data);
        $this->render('/Blogs/admin_edit_confirm');

      } else {
        //バリデーションエラーで画像/動画をセッションに保存
        $this->Session->write('Image', $this->request->data['Image']);


        if (!empty($this->request->data['image'])) {
          $photcount = 0;
          foreach ($this->request->data['image'] as $key => $value) {
            if (empty($value['id'])) {
              $photcount++;
            }
          }
          if (!empty($this->request->data['Check'])) {
            foreach ($this->request->data['Check'] as $key => $value) {
              $this->request->data['Check'][$key + $photcount] = $value;
            }
          }
          for ($i=0 ; $i < $photcount; $i++) {
            $this->request->data['Check'][$i] = 0;
          }
					//降順
          ksort($this->request->data['Check']);
        }

        return false;
      }
    } else {


			//初期処理
      if (isset($id)) {
        $status = array(
        'conditions' =>
          array(
            'Blog.id' => $id,
          )
        );
        // 以下がデータベース関係
        $this->request->data = $this->Blog->find('first', $status);
        if (!empty($this->request->data['Image'])) {
            $this->Session->write('image', $this->request->data['Image']);
        }


      }

    }


  }


  public function admin_edit_regist(){
      // レイアウト関係
		$this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
      //戻るボタン
			if (isset($this->request->data['back'])) {
        $Image = $this->Session->read('Image');
        $this->request->data['Image'] = $Image;

        //画像/動画をセッションに保存
        if (!empty($this->request->data['Image'])) {
          $this->Session->write('Image', $this->request->data['Image']);
        }

        $this->render('/Blogs/admin_edit');
			} elseif (isset($this->request->data['regist'])) {
        $data = $this->request->data;

        if (!empty($data['Image'])) {
          $data['Blog']['image_flag'] = 1;
          foreach ($data['Image'] as $key => $value) {
            $data['Image'][$key]['Image']['partner_name'] = 'Blog';
          }
        }


        $this->Blog->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Blog->validates()) {
          $this->Blog->save($data['Blog']);
            $partner_id = $data['Blog']['id'];

            if (!empty($data['photo_dele'])) {
              $data['photo_dele'] = array_merge($data['photo_dele']);
            }
            if (!empty($data['movie_dele'])) {
              $data['movie_dele'] = array_merge($data['movie_dele']);
            }
            //画像削除
            if (!empty($data['photo_dele'])) {
              foreach ($data['photo_dele'] as $key => $photo_dele) {
                $status = array(
                  'delete_flag' => 1,
                );
                $conditions = array(
                  'url' => $photo_dele,
                );
                $this->Image->updateAll($status, $conditions);
                $this->Image->create();
              }
            }



            if (!empty($data['Image'])) {
              foreach($data['Image'] as $key => $val){
									$cut = 1;//カットしたい文字数
									$val['Image']["url"] = substr( $val['Image']["url"] , $cut , strlen($val['Image']["url"])-$cut );
									$file = new File(WWW_ROOT.$val['Image']["url"]);
							    $file->copy(WWW_ROOT."/files/updir/" . $val['Image']["tmp_name"],true);
									$file = new File(WWW_ROOT.$val['Image']["url"]);
							    $file->delete();
                  $data['Image'][$key]['Image']["url"] = "/files/updir/" . $val['Image']["tmp_name"];
                  $data['Image'][$key]['Image']["partner_id"] = $partner_id;
                }
              foreach ($data['Image'] as $key => $value) {
              $this->Image->create(false);
              $this->Image->save($value['Image']);
              }
            }

          return $this->redirect( array('controller' => 'Blogs', 'action' => 'admin_index'));
        } else {
          $this->set('data',$data);
          $this->render('/Blogs/admin_add');
        }
      }
    }
  }

  /**/
  /*詳細箇所
  /*
  /*
  /*
  /*
  /*
  /**/

  public function admin_detail($id = null){
    // レイアウト関係
		$this->layout = "default";
    if (isset($id)) {
      $status = array(
      'conditions' =>
        array(
          'Blog.id' => $id,
          'Blog.delete_flag' => 0
        )
      );
      // 以下がデータベース関係
      $datas = $this->Blog->find('first', $status);
      if ($datas['Blog']['image_flag']) {
        $id = $datas['Blog']['id'];
        $status = array(
          'conditions' =>
          array(
            'partner_id' => $id,
            'partner_name' => 'Blog',
            'delete_flag' => '0'
          )
        );
        $datas['Image'] = $this->Image->find('all', $status);
      }
      $this->set('data',$datas);
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
      'Blog.id' => $id,
    );
    $this->Blog->updateAll($status, $conditions);
    return $this->redirect( array('controller' => 'Blogs', 'action' => 'admin_index'));
  }

	public function _getParameter() {
                $prefectures = $this->Master->getPrefecture();
                $side_content = $this->Master->getSideContent();
                $side_under_content = $this->Master->getSideRss();
                shuffle($side_content);
                $this->set(compact("prefectures", "side_content", 'side_under_content'));
		return;
	}
}
