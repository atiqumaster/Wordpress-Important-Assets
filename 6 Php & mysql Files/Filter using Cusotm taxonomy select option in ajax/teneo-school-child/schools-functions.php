<?php
function get_schools_listing_html_data($filters_arr = array( 'grade' => '', 'language' => '', 'curriculum' => '', 'examboard' => '' ) ){
	
	//print_r($filters_arr);
	
	
	 $teneo_args = array(
					'post_type'        => 'school',
					'post_status'      => 'publish',
					'suppress_filters' => false,
					'posts_per_page'  => -1
					
	);
	
	
	 $tax_args = array();
	 $taxonomies_count = 0;	
	 
	 $go_fees_link = site_url().'/fees/';
	
	if( isset($filters_arr['grade']) && $filters_arr['grade'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'grade',
            'field' => 'slug',
            'terms' => $filters_arr['grade']
       	 	);
		
		 $go_fees_link .= '?grade='.$filters_arr['grade'];	
		
		
	 }
	 
	 if( isset($filters_arr['language']) && $filters_arr['language'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'language',
            'field' => 'slug',
            'terms' => $filters_arr['language']
       	 	);
			
		
		 $go_fees_link .= '&language='.$filters_arr['language'];
		
			
	 }
	 
	 
	 if( isset($filters_arr['curriculum']) && $filters_arr['curriculum'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'curriculum',
            'field' => 'slug',
            'terms' => $filters_arr['curriculum']
       	 	);
		  
		  $go_fees_link .= '&curriculum='.$filters_arr['curriculum'];	
			
	 }
	 
	 if( isset($filters_arr['examboard']) && $filters_arr['examboard'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'examination_board',
            'field' => 'slug',
            'terms' => $filters_arr['examboard']
       	 	);
		  
		  $go_fees_link .= '&examboard='.$filters_arr['examboard'];
			
	 }
	 
	
	
	 if($taxonomies_count > 1) {
			$tax_args['relation'] = 'AND';
	 }
	 
	 if( count($tax_args) > 0 ) {
		$teneo_args['tax_query'] = $tax_args ;
	 }
	 	
	$all_schools_array = get_posts( $teneo_args );
	
	
	// starting content as empty
	$html_content = '';
	
	if( count($all_schools_array) > 0) {
		
		$html_content .= '<section class="container mt-3 px-5 school_fee_head">
    <div class="row section-two">
        <div class="col-12">
            <h3>The school for you:</h3>
        </div>
    
    </div>
</section>';
		
		foreach ($all_schools_array as $single_school) {
			$school_id = $single_school->ID;
			setup_postdata( $school_id );
			$school_title = $single_school->post_title;
			$how_we_do_it = get_field('how_we_do_it', $school_id);
			$why_it_works = get_field('why_it_works', $school_id);
			$from_per_month = get_field('from_x_per_month', $school_id);
			$all_you_need_know = get_field('all_you_need_to_know', $school_id);
			$all_you_need_know_link = get_field('all_you_need_to_know_link', $school_id);
			$layout_type = get_field('layout', $school_id);
			$grade_level_1st_column = get_field('grade_level_1st_column', $school_id);
			$second_column_left_title = get_field('second_column_left_title', $school_id);
			$third_column_right_title = get_field('third_column_right_title', $school_id);
			if($grade_level_1st_column == '') {
				$grade_level_1st_column = $school_title;
			}
			if($second_column_left_title == '') {
				$second_column_left_title = 'FLEX';
			}
			if($third_column_right_title == '') {
				$third_column_right_title = 'PLUS';
			}
			
			$flex_per_month = get_field('flex_per_month', $school_id);
			$plus_per_month = get_field('plus_per_month', $school_id);
			
			$second_column_hex_color_style = $third_column_hex_color_style = '';
			$second_column_hex_color = get_field('2nd_column_hex_color', $school_id);
			$third_column_hex_color = get_field('3rd_column_hex_color', $school_id);
			
			if($second_column_hex_color != '') {
				$second_column_hex_color_style = 'style="background-color: '.$second_column_hex_color.'"';
			}
			
			if($third_column_hex_color != '') {
				$third_column_hex_color_style = 'style="background-color: '.$third_column_hex_color.'"';
			}			
			
			
			
			if ($layout_type == 2) {
				
				$flex_per_month = $from_per_month;
				
				 $layout_based_table_classes = '<div class="col-xl-4 col-lg-4 col-md-4" >
													<div class="p-2 mb-0 bg-table-tag text-white text-center">Teacher-led real-time schools</div>
											  </div>
                              					<div class="col-xl-8 col-lg-8 col-md-8" >';
				
			}
			
			
			if ($layout_type == 3) {
				
				 $layout_based_table_classes = '<div class="col-xl-8 col-lg-8 col-md-8" >
													<div class="p-2 mb-0 bg-table-tag text-white text-center">Teacher-led real-time schools</div>
											  </div>
                              					<div class="col-xl-12 col-lg-12 col-md-12" >';
				
			}
			
			 
            
			// Second Section 
			$html_content .= '<section class="container second-section py-3 second-section-work" style="padding-left:unset;     box-shadow: 0px 2px 10px 0px #00000033; border-radius: 10px;" >
        <div class="container px-lg-5 px-md-5 px-sm-3 second-section-work-inner" >

            <div class="row my-3">
                <div class="col-lg-9 col-md-8 col-sm-12" style="background: #21205A;
                border-radius: 5px 49.4118px 49.4118px 5px;">
                <h4 class="text-white fs-3 py-2 px-4 " id="school_id_title_'.$school_id.'">
                '.$school_title.'                
              </h4>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6 col-md-12 col-sm-12 third-main-container me-4 py-3" style="width: 48%; ">
                    <h3 class="text-uppercase text-dark">how we do it </h3> 
                    <p class="text-dark"> '.$how_we_do_it.'
                    </p>  
                </div>
                
                <div class="col-lg-6 col-md-12 col-sm-12 third-main-container  py-3 " style="width: 48%; ">
                    <h3 class="text-uppercase text-dark">why it works </h3> 
                       '.$why_it_works.'
                </div>

            </div>
            
            <div class="row  my-4 py-3" style="background: linear-gradient(270deg, rgba(74, 51, 126, 0.6) 5.48%, rgba(166, 54, 180, 0.6) 50%);
            border-radius: 5px;">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <h2 class="text-white text-center fs-3" style="font-family: "Montserrat"; font-style: normal; font-weight: 700; font-size: 30px !important;line-height: 37px;" >From R'.$from_per_month.' Per Month</h2>
                    <a href="'.$go_fees_link.'" class="pt-2 text-primary text-center text_detail_school">Want more detail? See full fee breakdown here  </a>
                </div>
            </div>

            <div class="row my-3 bolg-all-you-need" >
                <div class="col-lg-8 col-md-12 col-sm-12 py-4" style="border: 1px solid rgba(208, 230, 244, 1); border-radius:10px; ">
                    <h5 class="text-dark all_need_title">All you need to know </h5> 
                    <p class="text-dark col-lg-7">'.$all_you_need_know.'
                    </p> 
                    <a href="'.site_url().'/download-info-pack/" > <button class="btn  rounded-pill px-5 button-one-all-you-need" style="background: #F9ED32;
                       box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);"> <img src="'.get_stylesheet_directory_uri().'/assets/images/FileArrowDown.png" alt=""> Download then comprehensive info pack</button> </a>
                    <a href="'.$all_you_need_know_link.'" ><button class="btn  rounded-pill px-5 button-two-all-you-need-mob" style="background: #F9ED32;
                      box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25); width: 100%;
                        margin-top: 20px;"> Download the info pack</button>   </a>
              </div>
                
            </div>
        </div>
    </section>';
	
	        
			$table_style_hide = ' display:none';
			if( have_rows('what_you_get', $school_id) ) {
				
				 $table_style_hide = '';
			       
				// Loop through rows.
				$heading_html = $flex_html = $plus_html = $table_rows_html = $third_column_plus_th_header = $last_td_plus = '' ;
				while( have_rows('what_you_get', $school_id) ) {
					
					 the_row();
					 $sub_heading  = get_sub_field('heading');
					 $sub_real_time_flex  = get_sub_field('real_time_flex');
					 $sub_real_time_plus  = get_sub_field('real_time_plus');
					 
					 if($sub_real_time_flex == 'True' || $sub_real_time_flex == 'true' ) {
						 $sub_real_time_flex = '<img src="'.get_stylesheet_directory_uri().'/assets/images/Vector-tick.png" alt="">';
					 } else if($sub_real_time_flex == 'False' || $sub_real_time_flex == 'false' ) {
						 $sub_real_time_flex = '<img src="'.get_stylesheet_directory_uri().'/assets/images/Vector (2).png" alt="">';
					 }
					 
					 if($sub_real_time_plus == 'True' || $sub_real_time_plus == 'true' ) {
						 $sub_real_time_plus = '<img src="'.get_stylesheet_directory_uri().'/assets/images/Vector-tick.png" alt="">';
					 } else if($sub_real_time_plus == 'False' || $sub_real_time_plus == 'false' ) {
						 $sub_real_time_plus = '<img src="'.get_stylesheet_directory_uri().'/assets/images/Vector (2).png" alt="">';
					 }
					 
				     
					 if($sub_heading != '' ) {
						$heading_html = '<td class=" table-first-col" >'.$sub_heading.'</td>'; 
					 } 
					 
					 if($sub_real_time_flex != '' ) {
						$flex_html = '<td class="table-flex-col" >'.$sub_real_time_flex.'</td>'; 
					 } 
					 
					 if($sub_real_time_plus != '' && $layout_type == 3) {
						$third_column_plus_th_header  =  '<th scope="col" class="table-plus-heading" '.$third_column_hex_color_style.'  >
                                     <div class="grade-heading-column" >
                                      <div class="row">
                                       <div class="col-lg-5 col-md-6 col-sm-12 " >
                                          <div class=" text-uppercase heading-real-time" id="realtime1" >real-time</div>
                                       </div>
                                       <div class="col-lg-4 col-md-4 col-sm-12 ">
                                          <h2  class="table_flex_head" >'.$third_column_right_title.'</h2>
                                       </div>
                                       <p class="table_flex_pra">R '.$plus_per_month.' monthly</p>
                                      </div>
                                     </div>
                                    </th>';
									
					   $plus_html = '<td class="table-plus-col" >'.$sub_real_time_plus.'</td>';	
					   $last_td_plus = '<td class="table-plus-col"><a href="'.$go_fees_link.'"><button class="btn_td_school_right" >Take me to fees</button></a></td>';	
					   
					   $mobile_plus_flex_btn = '<div class="mobile-plus-flex-buttons">
                         <button class="mobile-flex-button active_btn_tab_mob" id="flex-jquery-btn">  FLEX </button>
                       <button class="mobile-plus-button" id="plus-jquery-btn" > PLUS </button></div>';
										
					}
					
					$table_rows_html .= '<tr>'.$heading_html.$flex_html.$plus_html.'</tr>';				
			
					
				}
			
			}
		
	
	   // Third Section 
     $html_content .= '<section class=" py-4 third-section-table " style="padding-left:unset;'.$table_style_hide.'" > 
    <div class="container px-lg-5 px-md-5 px-sm-1  py-5" style="background: #FEFDFC; border: 1px solid #D0E6F4; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2); border-radius: 10px;" >
                        
               <!-- row One -->
                    <div class="row my-3 py-1">
                        <div class="col-lg-3 col-md-5 col-sm-6 heading-what-we-get" style="background: #21205A; border-radius: 5px 49.4118px 49.4118px 5px;">
                            <h4 class="text-white fs-3 py-2 px-4 " style="font-family: Montserrat; font-size: 26px !important; font-weight: 600; line-height: 32px; letter-spacing: 0em; text-align: left; color: white !important;" >
                                What you get
                            </h4>
                        </div>

                         '.$mobile_plus_flex_btn.'

                     </div>


                    
                    <!-- row  two-->
                   

                    <div class="row g-0 table-heading-top">   
                               
                        
                          <div class="col-xl-4 col-lg-4 col-md-4" >                       
                           </div>
						   
							  '.$layout_based_table_classes.'

                                <table class="table table-stripeding table_maintiance" > 
                                 <thead>
                                   <tr>
                                    <th scope="col"  class="table-first-heading">
                                     <div class="grade-heading-columns">
                                       <div class="row table_top_head" >
                                         <h2 >'.$grade_level_1st_column.'</h2>
                                         <p >How do they compare?</p>
                                       </div>
                                     </div>  
                                    </th>

                                    <th scope="col" class="table-flex-heading" '.$second_column_hex_color_style.' >
                                     <div class="grade-heading-column" >
                                       <div class="row">
                                         <div class="col-lg-5 col-md-6 col-sm-12  ">
                                           <div class=" text-uppercase heading-real-time" id="real-time">real-time</div>
                                         </div>
                                         <div class="col-lg-4 col-md-4 col-sm-12 ">
                                           <h2 class="table_flex_head" >'.$second_column_left_title.'</h2>    
                                         </div>
                                         <p class="table_flex_pra">R '.$flex_per_month.' monthly</p>
                                       </div>
                                     </div>
                                    </th>

                                      
									 '.$third_column_plus_th_header.' 
                                  

                                   </tr>
                                  </thead> 

                                  <tbody>
                                   '.$table_rows_html.'
                                      <tr>
                                       <td></td>
                                       <td class="table-flex-col"  ><a href="'.$go_fees_link.'"><button class="btn_td_school_left" >Take me to fees</button></a></td>
                                       '.$last_td_plus.'
                                      </tr>
                                    </tbody>
                                  </table>

                              </div>  
                            </div>    

                            

                                    
                                 

                            <div class="row py-4 table-last-buttons-one">
                              <div class="	col-xl-5  col-lg-7 py-2">
                              <a href="'.site_url().'/download-info-pack/" > <button class="btn w-100  rounded-pill pil_btn" > <img src="'.get_stylesheet_directory_uri().'/assets/images/FileArrowDown.png" alt=""> Download the comprehensive info pack</button></a>
                              </div>
                              <div class="col-xl-4 col-lg-5 py-2" >
                              <a href="http://enrolment.teneoschool.co.za/" > <button class="btn w-75  rounded-pill pil_btn_enroll"> Enrol now for 2023!</button></a>
                              </div>
                              <p class="py-3">Looking for parent led schooling? <a href="#" class="click_btn_filter" ><u>Click here</u></a> Have a look at our Homeschooling option &nbsp; &nbsp;<img src="'.get_stylesheet_directory_uri().'/assets/images/ArrowRight.png" alt=""></p>
                           </div>

   </div>                
</section>';
            
            
			
		} // loop end
		
		
		
		$html_content .= '<section class=" container">
<div class="row table-last-buttons-two">
                    <div class="col-sm-12 py-2 text-center d-flex flex-column">
                    
                      <a href="'.$all_you_need_know_link.'" >  <button class="btn   rounded-pill button-one-last" style="background: #F9ED32;
                        box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);
                        color: #16243E;  width:100% !important; margin-bottom:20px;
                        "> Download the info pack </button> </a>

                        <button class="btn  rounded-pill button-two-last" style="background: #FEFDFC;
                        border: 1px solid #198BD6;
                        box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);
                        color: #198BD6; width:100%;
                        "> Enrol now for 2023!</button>
                    </div>
                      
                </div>
</section>';


		
	}  // if end of school posts greater than 0
	
	
	return $html_content;
	
}