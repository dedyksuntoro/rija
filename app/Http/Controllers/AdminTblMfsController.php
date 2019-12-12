<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminTblMfsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "tbl_mfs";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pasien","name"=>"id_pasien","join"=>"tbl_data_pasien,nama"];
			$this->col[] = ["label"=>"Riwayat Jatuh","name"=>"riwayat_jatuh","join"=>"tbl_master_mfs,skala"];
			$this->col[] = ["label"=>"Diagnosis Sekunder","name"=>"diagnosis_sekunder","join"=>"tbl_master_mfs,skala"];
			$this->col[] = ["label"=>"Alat Bantu Pergerakan","name"=>"alat_bantu_pergerakan","join"=>"tbl_master_mfs,skala"];
			$this->col[] = ["label"=>"Terapi Intra Vena","name"=>"terapi_intra_vena","join"=>"tbl_master_mfs,skala"];
			$this->col[] = ["label"=>"Gait","name"=>"gait","join"=>"tbl_master_mfs,skala"];
			$this->col[] = ["label"=>"Status Mental","name"=>"status_mental","join"=>"tbl_master_mfs,skala"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Pasien','name'=>'id_pasien','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tbl_data_pasien,nama','datatable_where'=>'status != \'Checked\''];
			$this->form[] = ['label'=>'Riwayat Jatuh','name'=>'riwayat_jatuh','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','help'=>'baru-baru ini atau dalam 3 bulan terakhir','datatable_where'=>'item = \'Riwayat jatuh: baru-baru ini atau dalam 3 bulan terakhir\''];
			$this->form[] = ['label'=>'Diagnosis Sekunder','name'=>'diagnosis_sekunder','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Diagnosis Sekunder\''];
			$this->form[] = ['label'=>'Alat Bantu Pergerakan','name'=>'alat_bantu_pergerakan','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Alat bantu pergerakan\''];
			$this->form[] = ['label'=>'Terapi Intra Vena','name'=>'terapi_intra_vena','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Terapi intra vena\''];
			$this->form[] = ['label'=>'Gait','name'=>'gait','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Gait\''];
			$this->form[] = ['label'=>'Status Mental','name'=>'status_mental','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Status mental\''];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Pasien','name'=>'id_pasien','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tbl_data_pasien,nama'];
			//$this->form[] = ['label'=>'Riwayat Jatuh','name'=>'riwayat_jatuh','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','help'=>'baru-baru ini atau dalam 3 bulan terakhir','datatable_where'=>'item = \'Riwayat jatuh: baru-baru ini atau dalam 3 bulan terakhir\''];
			//$this->form[] = ['label'=>'Diagnosis Sekunder','name'=>'diagnosis_sekunder','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Diagnosis Sekunder\''];
			//$this->form[] = ['label'=>'Alat Bantu Pergerakan','name'=>'alat_bantu_pergerakan','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Alat bantu pergerakan\''];
			//$this->form[] = ['label'=>'Terapi Intra Vena','name'=>'terapi_intra_vena','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Terapi intra vena\''];
			//$this->form[] = ['label'=>'Gait','name'=>'gait','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Gait\''];
			//$this->form[] = ['label'=>'Status Mental','name'=>'status_mental','type'=>'select2','validation'=>'required|min:0','width'=>'col-sm-10','datatable'=>'tbl_master_mfs,skala','datatable_where'=>'item = \'Status mental\''];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
			$this->style_css = "
				#table-detail tr td:first-child {
					font-weight: bold;
					width: 25%;
				}
			";
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
		}

		public function getDetail($id) {
			//Create an Auth
			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
			  CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
			}
			
			$data = [];
			$data['page_title'] = 'Detail Data';
			$data['row'] = DB::table('tbl_mfs')
			->select(DB::raw('tbl_data_pasien.nama as nama_pasien, 
							riwayat_jatuh.skala as skala_riwayat_jatuh,
							diagnosis_sekunder.skala as skala_diagnosis_sekunder,
							alat_bantu_pergerakan.skala as skala_alat_bantu_pergerakan,
							terapi_intra_vena.skala as skala_terapi_intra_vena,
							gait.skala as skala_gait,
							status_mental.skala as skala_status_mental,
							riwayat_jatuh.skor + diagnosis_sekunder.skor + alat_bantu_pergerakan.skor + terapi_intra_vena.skor + gait.skor + status_mental.skor as mfs'))
			->leftJoin('tbl_data_pasien', 'tbl_mfs.id_pasien', '=', 'tbl_data_pasien.id')
			->leftJoin('tbl_master_mfs as riwayat_jatuh', 'tbl_mfs.riwayat_jatuh', '=', 'riwayat_jatuh.id')
			->leftJoin('tbl_master_mfs as diagnosis_sekunder', 'tbl_mfs.diagnosis_sekunder', '=', 'diagnosis_sekunder.id')
			->leftJoin('tbl_master_mfs as alat_bantu_pergerakan', 'tbl_mfs.alat_bantu_pergerakan', '=', 'alat_bantu_pergerakan.id')
			->leftJoin('tbl_master_mfs as terapi_intra_vena', 'tbl_mfs.terapi_intra_vena', '=', 'terapi_intra_vena.id')
			->leftJoin('tbl_master_mfs as gait', 'tbl_mfs.gait', '=', 'gait.id')
			->leftJoin('tbl_master_mfs as status_mental', 'tbl_mfs.status_mental', '=', 'status_mental.id')
			->where('tbl_mfs.id',$id)->first();
			
			//Please use cbView method instead view method from laravel
			$this->cbView('mfs_detail_view',$data);
		}


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here
			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
			//Your code here
			$id_pasien = DB::table('tbl_mfs')->where('id',$id)->first();
			DB::table('tbl_data_pasien')
				->where('id', $id_pasien->id_pasien)
				->update(['status' => 'Checked']);
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
			//Your code here
			//$postdata['skor_mfs'] = $postdata['riwayat_jatuh'] + $postdata['diagnosis_sekunder'] + $postdata['alat_bantu_pergerakan'] + $postdata['terapi_intra_vena'] + $postdata['gait'] + $postdata['status_mental'];
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here
			$id_pasien = DB::table('tbl_mfs')->where('id',$id)->first();
			DB::table('tbl_data_pasien')
				->where('id', $id_pasien->id_pasien)
				->update(['status' => 'Unchecked']);
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here
			
	    }



	    //By the way, you can still create your own method in here... :) 


	}