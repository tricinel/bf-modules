<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends BF_Model {

	protected $table		= "category";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_on";

	public function buildNavigationTree()
	{
		$arr = $this->getParentChildren();
		$new = array();
		
		foreach ($arr as $a){
		    $new[$a['category_parent_id']][] = $a;
		}
		
		$tree = $this->createTree($new, $new[0]);
		
		return $tree;
	}

	private function createTree(&$list, $parent){
	    $tree = array();
	    foreach ($parent as $k=>$l){
	        if(isset($list[$l['id']])){
	            $l['children'] = $this->createTree($list, $list[$l['id']]);
	        }
	        $tree[] = $l;
	    } 
	    return $tree;
	}

	private function getParentChildren(){
		$this->db->select('id, category_name, category_parent_id, category_url');
		$q = $this->db->get('category');

		$data = array();

		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$metadata = array('url'=>$row->category_url,'category_id'=>$row->id);
				$data[] = array('id'=>$row->id,'category_parent_id'=>$row->category_parent_id,'data'=>$row->category_name,'metadata'=>$metadata);
			}

			return $data;
		}

		return false;
	}
}
