<?php
App::uses('Component', 'Controller');
class MasterComponent extends Component {
        public $uses = array('Home', 'Blog', 'Rss', 'Image');
	public $components = array('Session');

	// ===== マスタ情報取得系 =====



        /**
         * 都道府県のKeyValueリスト取得
         *
         * @return array 都道府県のKeyValueリスト
         */
	public function getPrefecture () {
		// OppKindsMaster.phpと対応させる
		return array(
                     "" => "選択してください",
                    "1" => "北海道",
                    "2" => "青森県",
                    "3" => "岩手県",
                    "4" => "宮城県",
                    "5" => "秋田県",
                    "6" => "山形県",
                    "7" => "福島県",
                    "8" => "茨城県",
                    "9" => "栃木県",
                    "10" => "群馬県",
                    "11" => "埼玉県",
                    "12" => "千葉県",
                    "13" => "東京都",
                    "14" => "神奈川県",
                    "15" => "新潟県",
                    "16" => "富山県",
                    "17" => "石川県",
                    "18" => "福井県",
                    "19" => "山梨県",
                    "20" => "長野県",
                    "21" => "岐阜県",
                    "22" => "静岡県",
                    "23" => "愛知県",
                    "24" => "三重県",
                    "25" => "滋賀県",
                    "26" => "京都府",
                    "27" => "大阪府",
                    "28" => "兵庫県",
                    "29" => "奈良県",
                    "30" => "和歌山県",
                    "31" => "鳥取県",
                    "32" => "島根県",
                    "33" => "岡山県",
                    "34" => "広島県",
                    "35" => "山口県",
                    "36" => "徳島県",
                    "37" => "香川県",
                    "38" => "愛媛県",
                    "39" => "高知県",
                    "40" => "福岡県",
                    "41" => "佐賀県",
                    "42" => "長崎県",
                    "43" => "熊本県",
                    "44" => "大分県",
                    "45" => "宮崎県",
                    "46" => "鹿児島県",
                    "47" => "沖縄県"
                    );
	}

	public function getSideContent() {
                $Blog = ClassRegistry::init('Blog');
                $side_content = array();
		$status = array(
		'conditions' => array(
			'image_flag' => '1',
                        'Blog.delete_flag' => 0,
                        'release_flag' => 1
		),
		'limit' => 4,
		);
                
		// 以下がデータベース関係
		$side_content = $Blog->find('all', $status);
                
                return $side_content;
        }
        
        public function getSideRss() {
                $Rss = ClassRegistry::init('Rss');
                $side_under_content = array();
                $status = array(
			'conditions' =>
			array(
				'delete_flag' => 0
			),
                        'limit' => 4,
		);
		// 以下がデータベース関係
		$side_under_content = $Rss->find('all', $status);
                return $side_under_content;
        }
        
}
