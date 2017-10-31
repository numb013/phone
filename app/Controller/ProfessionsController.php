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
 * Redistributions of files must retain the above copyright Profession.
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
class ProfessionsController extends AppController {
	public $uses = array('Profession', 'Image', 'CheckLike', 'CheckPersonal', 'WriteDown');
	public $components = array('Search.Prg', 'Session', 'Master');
	public $presetVars = true;
	public $paginate = array();


	public function index($para = null) {

		//echo pr($this->request->query);
		//echo pr($this->request->data);
		//exit();
		$param = (!empty($_SERVER['QUERY_STRING'])) ? '?'.$_SERVER['QUERY_STRING'] : '';

		//echo pr($param);
		if (!empty($this->request->query['param'])) {
			$replaceText = str_replace("?", "", $this->request->query['param']);

			$array1 = array();
			parse_str($replaceText,  $array1);
			//echo pr($array1);
			if (!empty($array1['personal_check'])) {
				foreach ($array1['personal_check'] as $key => $value) {
					$this->request->query['personal_check'][$key] = $value;
				}
			}
		}

    // レイアウト関係
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Profession->parseCriteria($this->passedArgs);


		if (!empty($this->request->data)) {
			$back_flag = 1;
			$this->set('back_flag', $back_flag);
			$this->paginate['conditions']['profession.delete_flag'] = '0';
			$this->paginate = array(
				'conditions' => $this->paginate['conditions'],
				'order' => array(
					'created' => 'DESC',
				),
				'limit' => 8,
			);

			//$personalCheck = '';
			//foreach ($this->request->data['Profession']['personal_check'] as $key => $value) {
			//	if ($key == 0) {
			//		$Check[$key] = ' select * from professions T1 where T1.check_personal like "%,' . $value . ',%" or T1.check_personal like "'. $value . ',%" or T1.check_personal like "%,'. $value .'" AND T1.delete_flag = 0';
			//	} else {
			//		$Check[$key] = ' UNION ALL select * from professions T1 where T1.check_personal like "%,' . $value . ',%" or T1.check_personal like "'. $value . ',%" or T1.check_personal like "%,'. $value .'" AND T1.delete_flag = 0';
			//	}
			//	$personalCheck = $personalCheck . $Check[$key];
			//};
//
			//$sql = "select Profession.*, Image.url from
			//(select v_hit.*, COUNT('X') as cnt
			//from
			// (".$personalCheck.") as v_hit GROUP BY v_hit.id ) As Profession
			//	LEFT JOIN images As Image
			//	ON (Profession.id = Image.partner_id)
			// where Profession.cnt >= 3 AND Image.delete_flag = 0 GROUP BY Profession.id";
//
			//$this->paginate = $sql; //$sqlの中身は生SQL

		} else {
			// 初期表示時
			$this->paginate = array(
				'conditions' => array(
				   'delete_flag' => '0'
				 ),
				'order' => array(
					'created' => 'DESC',
				),
				'limit' => 8,
			);
			$back_flag = 1;
			$flag = 1;
			$this->set(compact('flag', 'back_flag'));
		}

		$datas = $this->paginate('Profession');
		$count = count($datas);


		//$datas = $this->paginate();
		//$count = count($datas);

		//echo pr($this->Profession->getDataSource()->getLog());
		//exit();
		//echo pr($datas);
		//exit();

		$this->_getCheckParameter();
    $this->set(compact('datas', 'para', 'param', 'count'));
	}

  public function search_more($para = null) {
    $param = (!empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : '';
		$this->_getCheckParameter();
		$back_flag = 1;
    $this->set(compact('datas', 'para', 'param', 'back_flag'));
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
				'Profession.id' => $id,
				'Profession.delete_flag' => 0
			)
		);
		// 以下がデータベース関係
		$datas = $this->Profession->find('first', $status);
	//echo pr($datas);
	//exit();
		if (!empty($datas['Profession']['image_flag'])) {
			$id = $datas['Profession']['id'];
			$status = array(
				'conditions' =>
				array(
					'partner_id' => $id,
					'partner_name' => 'Profession',
					'delete_flag' => '0'
				)
			);
			$datas['Image'] = $this->Image->find('all', $status);
		}


	//echo pr($datas);
	//exit();

		if (!empty($datas['Profession']['movie_flag'])) {
			$id = $datas['Profession']['id'];
			$status = array(
				'conditions' =>
				array(
					'partner_id' => $id,
					'partner_name' => 'Profession',
					'delete_flag' => '0'
				)
			);
			$datas['Movie'] = $this->Movie->find('all', $status);
		}

		$this->set('title_for_layout', $datas['Profession']['profession_name'].'の仕事内容・なりかた・給料・向いてる性格');
		$datas['title'] = $datas['Profession']['profession_name'].'の仕事内容・なりかた・給料・向いてる性格';
		$datas['Profession']['check_personal'] = explode(",", $datas['Profession']['check_personal']);
		$datas['Profession']['check_like'] = explode(",", $datas['Profession']['check_like']);
		$datas['Profession']['related_profession'] = explode(",", $datas['Profession']['related_profession']);

		$id = $datas['Profession']['id'];
		$status = array(
			'conditions' =>
			array(
				'profession_id' => $id,
				'up_flag' => 0,
				'delete_flag' => 0
			),
			'order' => array(
				'created' => 'DESC',
			),
		);
		$datas['write'] = $this->WriteDown->find('all', $status);

		$this->_getSideContent($datas);
		$this->_getCheckParameter();
		$know_flag = 1;
		//直接urlからきたら$first来たら来たらをviewにおくる
		if (empty($first)) {
			$first = 1;
			$this->set('first', $first);
		}
		$this->set(compact('datas', 'know_flag'));
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
		$data['id'] =  $this->request->data['Profession']['id'];
		$data['class'] = $this->request->data['Profession']['class'];
			$knowCount = $this->Profession->find('first', array(
				'fields' => array(
					'Profession.know_count',
				),
				'conditions' => array(
					'Profession.id' => $data['id'],
				),
				'recursive'  => -1
			));
			if ($this->request->data['Profession']['class'] == 'know_count plus') {
	        $action = 'plus';
					$data['Profession']['know_count'] = $knowCount['Profession']['know_count'] + 1;
			} else {
	      	$action = 'minus';
					$data['Profession']['know_count'] = $knowCount['Profession']['know_count'] - 1;
			}
			$this->Profession->updateAll(
				array(
					'Profession.modified' => "'" . date('Y-m-d H:i:s') . "'",
					'Profession.know_count' => $data['Profession']['know_count'],
				),
				array(
					'Profession.id' => $data['id'],
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
		$data['profession_id'] =  $this->request->data['wirte_down']['profession_id'];
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
                $this->paginate['conditions'] = $this->Profession->parseCriteria($this->passedArgs);
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
			$this->paginate['conditions']['Profession.delete_flag'] = '0';
		}

		//echo pr($this->paginate['conditions']);
		//exit();

		$datas = $this->paginate();
		foreach ($datas as $key => $data) {
			$datas[$key]['Profession']['check_personal'] = explode(",", $data['Profession']['check_personal']);
			$datas[$key]['Profession']['check_like'] = explode(",", $data['Profession']['check_like']);
		}
		$this->_getCheckParameter();
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
		//動画処理
      foreach ($this->request->data['Movie'] as $key => $value) {
        if ($value['movie_uuid'] == 'fast') {
          $this->request->data['Movie'][$key]['movie_uuid'] = rand(11111,99999);
        }
      }
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

      if (empty($this->request->data['Movie'][0]['movie_url'])) {
          unset($this->request->data['Movie'][0]);
      }
      if ($this->Session->read('Movie')) {
        $Movie = $this->Session->read('Movie');
        $count = count($this->request->data['Movie']);
        if ($count == 0) {
          $this->request->data['Movie'] = $Movie;
        } else {
          $countkey = $count - 1;
          foreach ($this->request->data['Movie'] as $key => $movies) {
            if ($key == $countkey) {
              foreach ($Movie as $key => $value) {
                $this->request->data['Movie'][$count] = $value;
                $count++;
              }
            }
          }
        }
        $this->Session->delete('Movie');
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


      //動画url修正
      foreach ($this->request->data['Movie'] as $key => $value) {
        if(preg_match('/youtube/', $value['movie_url'])){
          $this->request->data['Movie'][$key]['movie_url'] = str_replace('https://www.youtube.com/watch?v=', '', $this->request->data['Movie'][$key]['movie_url']);
        } else {
          $this->request->data['Movie'][$key]['movie_url'] = $value['movie_url'];
        }
      }



      $this->Profession->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Profession->validates()) {

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

        //動画削除
        if (!empty($this->request->data['Check_Movie'])) {
          foreach ($this->request->data['Check_Movie'] as $key => $Checkd) {
            if ($Checkd['movie'] != '0') {
              foreach ($this->request->data['Movie'] as $key => $Movie) {
                if ($Movie['movie_uuid'] == $Checkd['movie']) {
                    unset($this->request->data['Movie'][$key]);
                }
              }
            }
          }
          $this->request->data['Movie'] = array_merge($this->request->data['Movie']);
        }


				$this->_getCheckParameter();


				$options = array(
					'fields' => array(
						'Profession.id','Profession.profession_name'
					),
					'conditions' =>
					array(
						'delete_flag' => '0'
					),
					'recursive'  => -1
				);

				$relatedProfessions = $this->Profession->find('all', $options);

				foreach ($relatedProfessions as $key => $relatedProfession) {
					$relatedNmae[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
				}
				$this->set('relatedNmae', $relatedNmae);
        $this->set('data',$this->request->data);
        $this->render('/Professions/admin_confirm');

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

        if (!empty($this->request->data['Check_Movie'])) {
          foreach ($this->request->data['Check_Movie'] as $key => $Checkd) {
            if ($Checkd['movie'] != '0') {
              foreach ($this->request->data['Movie'] as $key => $Movie) {
                if ($Movie['movie_uuid'] == $Checkd['movie']) {
                  unset($this->request->data['Movie'][$key]);
                }
              }
            }
          }
        }

        //バリデーションエラーで画像/動画をセッションに保存
        $this->Session->write('image', $this->request->data['Image']);
        $this->Session->write('Movie', $this->request->data['Movie']);
        $this->request->data['Movie'] = array_merge($this->request->data['Movie']);
        foreach ($this->request->data['Movie'] as $key => $MovieValue) {
            $num = $key + 1;
            $this->request->data['Movie'][$num] = $MovieValue;
        }

        $this->request->data['Movie'][0] = '';
        return false;
      }
    }

		$options = array(
			'fields' => array(
				'Profession.id','Profession.profession_name'
			),
			'conditions' =>
			array(
				'delete_flag' => '0'
			),
			'recursive'  => -1
		);
		$relatedProfessions = $this->Profession->find('all', $options);

		foreach ($relatedProfessions as $key => $relatedProfession) {
			$related[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
		}
		$this->set('related', $related);
		$this->_getCheckParameter();


    $this->Session->delete('image');
    $this->Session->delete('Movie');
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
        if (!empty($this->request->data['Movie'])) {
          $this->Session->write('Movie', $this->request->data['Movie']);

          foreach ($this->request->data['Movie'] as $key => $MovieValue) {
            $num = $key + 1;
            $this->request->data['Movie'][$num] = $MovieValue;
          }
        }
        $this->request->data['Movie'][0] = '';
				$this->_getCheckParameter();

				$options = array(
					'fields' => array(
						'Profession.id','Profession.profession_name'
					),
					'conditions' =>
					array(
						'delete_flag' => '0'
					),
					'recursive'  => -1
				);
				$relatedProfessions = $this->Profession->find('all', $options);
				foreach ($relatedProfessions as $key => $relatedProfession) {
					$related[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
				}
				$this->set('related', $related);

        $this->render('/Professions/admin_add');
			} elseif (isset($this->request->data['regist'])) {

				$this->request->data['Profession']['check_personal'] = implode(",", $this->request->data['Profession']['check_personal']);
				$this->request->data['Profession']['check_like'] = implode(",", $this->request->data['Profession']['check_like']);
				$this->request->data['Profession']['related_profession'] = implode(",", $this->request->data['Profession']['related_profession']);
        $data = $this->request->data;

        if (!empty($data['Image'])) {
          $data['Profession']['image_flag'] = 1;
          foreach ($data['Image'] as $key => $value) {
            $data['Image'][$key]['partner_name'] = 'Profession';
          }
        }
        if (!empty($data['Movie'])) {
          $data['Profession']['movie_flag'] = 1;
          foreach ($data['Movie'] as $key => $value) {
            $data['Movie'][$key]['partner_name'] = 'Profession';
          }
        }
        $this->Profession->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Profession->validates()) {
          $this->Profession->save($data['Profession']);
            $partner_id = $this->Profession->getLastInsertID();


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
            if (!empty($data['Movie'])) {
              foreach ($data['Movie'] as $key => $value) {
                $value["partner_id"] = $partner_id;
                $this->Movie->create(false);
                $this->Movie->save($value);
              }
            }
          return $this->redirect(
            array('controller' => 'Professions', 'action' => 'admin_index')
          );
        } else {

          $this->set('data',$data);
          $this->render('/Professions/admin_add');
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

		// $Movie = $this->Session->read('Movie');
		// echo 'movie-sesssion';
		// echo '<br>';
		// echo pr($Movie);
		// echo 'movie';
		// echo '<br>';
		// echo pr($this->request->data['Movie']);



		//動画にユニークID入れる
    foreach ($this->request->data['Movie'] as $key => $value) {
      if ($value['movie_uuid'] == 'fast') {
        $this->request->data['Movie'][$key]['movie_uuid'] = rand(11111,99999);
      }
    }
		//画像がエラーの物削除
    foreach ($this->request->data['Image'] as $key => $value) {
        if ($value['error'] == 4) {
          unset($this->request->data['Image'][$key]);
        }
    }
    $this->request->data['Image'] = array_merge($this->request->data['Image']);
		//画像セッション読み込み
    if ($this->request->data['Profession']['BeforeImage']) {
      $count = count($this->request->data['Image']);
			//追加なければセッションの値そのまま入れる
      if ($count == 0) {
        $this->request->data['Image'] = $this->request->data['Profession']['BeforeImage'];
      } else {
        $countkey = $count - 1;
        foreach ($this->request->data['Image'] as $key => $phots) {
          if ($key == $countkey) {
            foreach ($this->request->data['Profession']['BeforeImage'] as $key => $value) {
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
    if (empty($this->request->data['Movie'][0]['movie_url'])) {
        unset($this->request->data['Movie'][0]);
    }
		//順番整える
    $this->request->data['Movie'] = array_merge($this->request->data['Movie']);
    if ($this->Session->read('Movie')) {
			//動画セッション読み込み
	    $Movie = $this->Session->read('Movie');
      $count = count($this->request->data['Movie']);
      if ($count == 0) {
        $this->request->data['Movie'] = $Movie;
      } else {
        foreach ($Movie as $key => $value) {
          if (!empty($value)) {
            $this->request->data['Movie'][$count] = $value;
            $count++;
          }
        }
      }
      $this->Session->delete('Movie');
    }

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

			//動画アップロード形式に反感
      foreach ($this->request->data['Movie'] as $key => $value) {
        if (!empty($value)) {
          if(preg_match('/youtube/', $value['movie_url'])){
            $this->request->data['Movie'][$key]['movie_url'] = str_replace('https://www.youtube.com/watch?v=', '', $this->request->data['Movie'][$key]['movie_url']);
          } else {
            $this->request->data['Movie'][$key]['movie_url'] = $value['movie_url'];
          }
        }
      }

      $this->Profession->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Profession->validates()) {
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
				//動画削除チェックの入ったものを削除
        if (!empty($this->request->data['Check_Movie'])) {
          foreach ($this->request->data['Check_Movie'] as $key => $Checkd) {
            if ($Checkd['movie_uuid'] != '0') {
              foreach ($this->request->data['Movie'] as $key => $Movie) {
              if (!empty($Movie['movie_uuid'])) {
                if ($Movie['movie_uuid'] == $Checkd['movie_uuid']) {
                    unset($this->request->data['Movie'][$key]);
                }}
              }
            }
          }
          if (empty($this->request->data['Movie'][0]["movie_url"])) {
            unset($this->request->data['Movie'][0]);
          }
        }
        $this->request->data['Movie'] = array_merge($this->request->data['Movie']);


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

			//最初に削除していて一回「戻るボタン」して再度「確認」押下時に必要処理
			//再度削除処理にセットしている
      if (!empty($this->request->data['movie_dele'])) {
        if (!empty($this->request->data['Check_Movie'])) {
          $moviecount = count($this->request->data['Check_Movie']);
          foreach ($this->request->data['Check_Movie'] as $key => $CheckMovie) {
              foreach ($this->request->data['movie_dele'] as $key => $movie_dele) {
                if ($movie_dele != '0') {
                  $this->request->data['Check_Movie'][$moviecount + $key]['movie_uuid'] = $movie_dele;
                }
              }
          }
        } elseif (!empty($this->request->data['movie_dele'])) {
          foreach ($this->request->data['movie_dele'] as $key => $movie_dele) {
            $this->request->data['Check_Movie'][$key]['movie_uuid'] = $movie_dele;
          }
        }
      }

			//array_uniqueはソートしてくれる
			//array_mergeは重複削除
      if (!empty($this->request->data['movie_dele'])) {
        $this->request->data['Check_Movie'] = array_unique($this->request->data['Check_Movie']);
        $this->request->data['Check_Movie'] = array_merge($this->request->data['Check_Movie']);
        $this->request->data['movie_dele'] = array_unique($this->request->data['movie_dele']);
        $this->request->data['movie_dele'] = array_merge($this->request->data['movie_dele']);

      }

      if (!empty($this->request->data['photo_dele'])) {
        $this->request->data['Check'] = array_unique($this->request->data['Check']);
        $this->request->data['Check'] = array_merge($this->request->data['Check']);
        $this->request->data['photo_dele'] = array_unique($this->request->data['photo_dele']);
        $this->request->data['photo_dele'] = array_merge($this->request->data['photo_dele']);
      }

        //画像/動画をセッションに保存
        $this->Session->write('Image', $this->request->data['Image']);
        $this->Session->write('Movie', $this->request->data['Movie']);
				$this->_getCheckParameter();


				$options = array(
					'fields' => array(
						'Profession.id','Profession.profession_name'
					),
					'conditions' => array(
						'delete_flag' => '0',
					),
					'recursive'  => -1
				);

				$relatedProfessions = $this->Profession->find('all', $options);
				foreach ($relatedProfessions as $key => $relatedProfession) {
					$relatedNmae[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
				}
				$this->set('relatedNmae', $relatedNmae);
        $this->set('data',$this->request->data);
        $this->render('/Professions/admin_edit_confirm');

      } else {
        //バリデーションエラーで画像/動画をセッションに保存
        $this->Session->write('Image', $this->request->data['Image']);
        $this->Session->write('Movie', $this->request->data['Movie']);

        if (!empty($this->request->data['Movie'][0]['movie_url'])) {
          foreach ($this->request->data['Movie'] as $key => $MovieValue) {
            $num = $key + 1;
            $this->request->data['Movie'][$num] = $MovieValue;
          }
          $this->request->data['Movie'][0] = '';
        }

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

        if (!empty($this->request->data['Movie'])) {
          $moviecount = 0;
          foreach ($this->request->data['Movie'] as $key => $value) {
            if (empty($value['id']) && !empty($value['movie_url'])) {
              $moviecount++;
            }
          }
          if (!empty($this->request->data['Check_Movie'])) {
            $this->request->data['Check_Movie'][0]['movie_uuid'] = 0;
            foreach ($this->request->data['Check_Movie'] as $key => $value) {
              $this->request->data['Check_Movie'][$key + $moviecount]['movie_uuid'] = $value['movie_uuid'];
            }
          }
          for ($i=0 ; $i < $moviecount + 1; $i++) {
            $this->request->data['Check_Movie'][$i]['movie_uuid'] = 0;
          }
          ksort($this->request->data['Check_Movie']);
        }
        return false;
      }
    } else {


			//初期処理
      if (isset($id)) {
        $status = array(
        'conditions' =>
          array(
            'Profession.id' => $id,
          )
        );
        // 以下がデータベース関係
        $this->request->data = $this->Profession->find('first', $status);

				$this->request->data['Profession']['check_personal'] = explode(",", $this->request->data['Profession']['check_personal']);
				$this->request->data['Profession']['check_like'] = explode(",", $this->request->data['Profession']['check_like']);
				$this->request->data['Profession']['related_profession'] = explode(",", $this->request->data['Profession']['related_profession']);

        if (!empty($this->request->data['Movie'])) {
          foreach ($this->request->data['Movie'] as $key => $MovieValue) {
            $this->request->data['Movie'][$key + 1] = $MovieValue;
          }
          $this->request->data['Movie'][0] = '';
          $this->Session->write('Movie', $this->request->data['Movie']);
        }

				if (!empty($this->request->data['Image'])) {
            $this->Session->write('image', $this->request->data['Image']);
        }
				$this->_getCheckParameter();

				$options = array(
					'fields' => array(
						'Profession.id','Profession.profession_name'
					),
					'conditions' =>
					array(
						'delete_flag' => '0'
					),
					'recursive'  => -1
				);
				$relatedProfessions = $this->Profession->find('all', $options);
				foreach ($relatedProfessions as $key => $relatedProfession) {
					$related[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
				}
				$this->set('related', $related);
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
        $Movie = $this->Session->read('Movie');
        $this->request->data['Movie'] = $Movie;
        //画像/動画をセッションに保存
        if (!empty($this->request->data['Image'])) {
          $this->Session->write('Image', $this->request->data['Image']);
        }

        if (!empty($this->request->data['Movie'])) {
          $this->Session->write('Movie', $this->request->data['Movie']);
          $num = 1;
          foreach ($this->request->data['Movie'] as $key => $MovieValue) {
            if (!empty($MovieValue)) {
              $this->request->data['Movie'][$num] = $MovieValue;
              $num++;
            }
          }
        }
        $this->request->data['Movie'][0] = '';
        $this->request->data['Movie'] = $this->request->data['Movie'];
				$this->_getCheckParameter();

				$options = array(
					'fields' => array(
						'Profession.id','Profession.profession_name'
					),
					'conditions' =>
					array(
						'delete_flag' => '0'
					),
					'recursive'  => -1
				);

				$relatedProfessions = $this->Profession->find('all', $options);

				foreach ($relatedProfessions as $key => $relatedProfession) {
					$related[$relatedProfession['Profession']['id']] = $relatedProfession['Profession']['profession_name'];
				}
				$this->set('related', $related);

        $this->render('/Professions/admin_edit');
			} elseif (isset($this->request->data['regist'])) {
        $data = $this->request->data;

				$data['Profession']['check_personal'] = implode(",",$data['Profession']['check_personal']);
				$data['Profession']['check_like'] = implode(",", $data['Profession']['check_like']);
				$data['Profession']['related_profession'] = implode(",", $data['Profession']['related_profession']);


        if (!empty($data['Image'])) {
          $data['Profession']['image_flag'] = 1;
          foreach ($data['Image'] as $key => $value) {
            $data['Image'][$key]['Image']['partner_name'] = 'Profession';
          }
        }



        if (!empty($data['Movie'])) {
          $data['Profession']['movie_flag'] = 1;
          foreach ($data['Movie'] as $key => $value) {
            $data['Movie'][$key]['Movie']['partner_name'] = 'Profession';
          }
        }

        $this->Profession->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Profession->validates()) {
          $this->Profession->save($data['Profession']);
            $partner_id = $data['Profession']['id'];

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

            //画像削除
            if (!empty($data['movie_dele'])) {
              foreach ($data['movie_dele'] as $key => $movie_dele) {
                $status = array(
                  'delete_flag' => 1,
                );
                $conditions = array(
                  'movie_uuid' => $movie_dele,
                );
                $this->Movie->updateAll($status, $conditions);
                $this->Movie->create();
              }
            }

            if (!empty($data['Movie'])) {
              $data['Movie'] = array_merge($data['Movie']);
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
            //動画登録
            if (!empty($data['Movie'])) {
              foreach ($data['Movie'] as $key => $value) {
                if (empty($value['Movie']['id'])) {
                  $value['Movie']["partner_id"] = $partner_id;
                  $this->Movie->create(false);
                  $this->Movie->save($value);
                }
              }
            }
          return $this->redirect( array('controller' => 'Professions', 'action' => 'admin_index'));
        } else {
          $this->set('data',$data);
          $this->render('/Professions/admin_add');
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
          'Profession.id' => $id,
          'Profession.delete_flag' => 0
        )
      );
      // 以下がデータベース関係
      $datas = $this->Profession->find('first', $status);
      if ($datas['Profession']['image_flag']) {
        $id = $datas['Profession']['id'];
        $status = array(
          'conditions' =>
          array(
            'partner_id' => $id,
            'partner_name' => 'Profession',
            'delete_flag' => '0'
          )
        );
        $datas['Image'] = $this->Image->find('all', $status);
      }

      if ($datas['Profession']['movie_flag']) {
        $id = $datas['Profession']['id'];
        $status = array(
          'conditions' =>
          array(
            'partner_id' => $id,
            'partner_name' => 'Profession',
            'delete_flag' => '0'
          )
        );
        $datas['Movie'] = $this->Movie->find('all', $status);
      }

			$datas['Profession']['check_personal'] = explode(",", $datas['Profession']['check_personal']);
			$datas['Profession']['check_like'] = explode(",", $datas['Profession']['check_like']);



			$this->_getCheckParameter();

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
      'Profession.id' => $id,
    );
    $this->Profession->updateAll($status, $conditions);
    return $this->redirect( array('controller' => 'Professions', 'action' => 'admin_index'));
  }

	public function _getSideContent($datas = null) {
		//$status = array(
		//'conditions' => array(
		//	'image_flag' => '1'
		//),
		//'order' => array(
		//	'created' => 'DESC'
		//),
		//'limit' => 6,
		//);
		// 以下がデータベース関係
		//$new_content = $this->Profession->find('all', $status);
		$status = array(
			'fields' => array(
				'Profession.id', 'Profession.profession_name', 'job_salary', 'personality'
			),
			'conditions' =>
			array(
				'Profession.id' => $datas['Profession']['related_profession'],
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

	public function _getCheckParameter() {
		$check_personals = $this->Master->getCheckPersonals();
		$check_likes = $this->Master->getCheckLikes();
		$like_checks = $this->Master->getLikeChecks();
		$genre = $this->Master->getGenre();
		$like_genre = $this->Master->getlikeGenre();
		$this->set(compact("check_likes", "check_personals", "genre", "like_genre", "like_checks"));
		return;
	}
}
