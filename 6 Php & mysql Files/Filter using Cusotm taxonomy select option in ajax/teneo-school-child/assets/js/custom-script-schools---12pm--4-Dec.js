jQuery(document).ready(function(e) {
	
 jQuery('input[type=radio][name=curriculum]').change(function() {
	var selected_grade_c = jQuery('.grade_filter option:selected').val(); 
	 
	 if(selected_grade_c == "grade-8" || selected_grade_c == "grade-9"){
		jQuery('.examination_board_section').hide();
		jQuery('input[name="examboard"]').prop('checked', false); 
	 } else {
	    jQuery('.examination_board_section').show();
	 }
	 
	 
    if (this.value == 'south-african') {
		jQuery('.examination_board_24').hide();
        jQuery('.examination_board_22').show();
		jQuery('.examination_board_23').show();
    }
    else if (this.value == 'british-international') {
       jQuery('.examination_board_22').hide();
	   jQuery('.examination_board_23').hide();
	   jQuery('.examination_board_24').show();
	  
	  
    }
});
//reset form values
jQuery('.reset_school_search').click(function(event){
	event.preventDefault();
	jQuery('.curriculum_section').hide();
	jQuery('.examination_board_section').hide();

	jQuery('#all-schools-fees-listing-section').html('');
	jQuery('input[name="curriculum"]').prop('checked', false);
	jQuery('input[name="examboard"]').prop('checked', false);
	jQuery('select.grade_filter').val('');
	jQuery('select.language_filter').val('');
	jQuery("#school_search_form").trigger("reset"); //it doesn't work 100% so manual code below
	
});

// if grader is above 8 then curriculm section will show
jQuery(".grade_filter, .language_filter").change(function () {
	var selected_grade = jQuery('.grade_filter option:selected').val();
	if(selected_grade == "grade-8" || selected_grade == "grade-9" || selected_grade == "grade-10" || selected_grade == "grade-11" || selected_grade == "grade-12"){
		
		 var language_val = jQuery('.language_filter option:selected').val();
		 if(language_val == 'english') {
		    jQuery('.curriculum_section').show();
			jQuery('.examination_board_section').hide();
			jQuery('input[name="examboard"]').prop('checked', false); 
		 } else {
			jQuery('.curriculum_section').hide();
			jQuery('.examination_board_section').hide();
			jQuery('input[name="curriculum"]').prop('checked', false);
			jQuery('input[name="examboard"]').prop('checked', false); 
		 }
		 
	} else if(selected_grade == "adult-matric"){
		
		jQuery('.curriculum_section').hide();
		jQuery('.examination_board_section').show();
		jQuery('.examination_board_22').hide();
	    jQuery('.examination_board_24').hide();
	    jQuery('.examination_board_23').show();
		jQuery('.examination_board_23 input.examboard_filter').prop('checked', true);
		
	} else {
		jQuery('.curriculum_section').hide();
		jQuery('.examination_board_section').hide();
		jQuery('input[name="curriculum"]').prop('checked', false);
		jQuery('input[name="examboard"]').prop('checked', false);
	}
	
	
	if(selected_grade == "grade-10" || selected_grade == "grade-11" || selected_grade == "grade-12"){
		
		if( jQuery('.curriculum_filter').is(':checked') ) {
			jQuery('.examination_board_section').show();
		}
		
	} else if(selected_grade != "adult-matric"){
		
		jQuery('.examination_board_section').hide();
		
	}
	
	
 });
 
 
 
	   function is_teneo_ajax_flag_true () {
			 
			   var ajax_check_flag = false; 
			   var grade_selection = jQuery('.grade_filter option:selected').val();
			   var language_selection = jQuery('.language_filter option:selected').val();
			   
			   if(grade_selection != '' && language_selection == 'afrikaans') {
					ajax_check_flag = true;
				}
				
			   if(grade_selection != '' && language_selection == 'english') {
					
					if(grade_selection == "grade-8" || grade_selection == "grade-9"){
					  
						  if( jQuery('.curriculum_filter').is(':checked') ) {
								ajax_check_flag = true;
						  }  
				   
					} else if(grade_selection == "grade-10" || grade_selection == "grade-11" || grade_selection == "grade-12" ||  grade_selection == "adult-matric---"){
					  
						  if( jQuery('.curriculum_filter').is(':checked') && jQuery('.examboard_filter').is(':checked') ) {
								ajax_check_flag = true;
						  }
					  
				   
					} else {
						// grade below 8
						ajax_check_flag = true;
					}
	
				}
			 
			 return ajax_check_flag;
			 
		 }
		 
		 
		function process_teneo_filters_ajax_request () {
			 
			    var filters_type = jQuery('#filters_type').val();
				  if(filters_type == 'schools') {
					 var filter_action =  'school_search_filter_function';
				  }
				  
				 if(filters_type == 'fees') {
					 var filter_action =  'fees_search_filter_function';  
				 }
				
				  jQuery('.fist-section-filter').css("opacity", 0.5);
				  // jQuery('#schools-ajax-loading').show();
				  var all_data = jQuery("form#school_search_form").serialize();
				  var data = {
						action: filter_action,
						all_data: all_data
					 }; 
					 
				 jQuery.post(custom_ajaxurl, data, function (response){
					// jQuery('#schools-ajax-loading').hide();
					 jQuery('#all-schools-fees-listing-section').show();
					 jQuery('.fist-section-filter').css("opacity", 1);  
					  if(response.success=='sent'){
							 jQuery('#all-schools-fees-listing-section').html(response.schools_listing);
					  }
					  
				}, 'json');
			 
		 }
 
		//sending AJAX request on filter changes
 		jQuery(".grade_filter, .language_filter, .curriculum_filter, .examboard_filter").change(function () {
	 
		   			 jQuery('#all-schools-fees-listing-section').html('');
			   
					 if( jQuery(window).width() > 767 && is_teneo_ajax_flag_true()  ) {
						 process_teneo_filters_ajax_request();		
					 }
				
		});
		
		
		jQuery(document).on("click","#find_my_school_btn",function(e) {
				
				jQuery('#all-schools-fees-listing-section').html('');
			   
				 if( is_teneo_ajax_flag_true() ) {
					 process_teneo_filters_ajax_request();		
				 }
				
		});
		
		
		jQuery(document).on("click","#flex-jquery-btn",function(e) {
			
				if ( ! jQuery(this).hasClass("active_btn_tab_mob") ) {
					jQuery(this).addClass("active_btn_tab_mob");
					jQuery('th.table-flex-heading, td.table-flex-col').show();
					jQuery('#plus-jquery-btn').removeClass("active_btn_tab_mob");
					jQuery('th.table-plus-heading, td.table-plus-col').hide();
					
				}			
				
		});
		
		jQuery(document).on("click","#plus-jquery-btn",function(e) {
			
				if ( ! jQuery(this).hasClass("active_btn_tab_mob") ) {
					jQuery(this).addClass("active_btn_tab_mob");
					jQuery('th.table-plus-heading, td.table-plus-col').show();
					jQuery('#flex-jquery-btn').removeClass("active_btn_tab_mob");
					jQuery('th.table-flex-heading, td.table-flex-col').hide();
				}			
				
		});
	

});