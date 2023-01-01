<?php
function get_fees_data_school_listing_html($filters_arr = array( 'grade' => '', 'language' => '', 'curriculum' => '', 'examboard' => '' ) ){
	
	//print_r($filters_arr);
	
	
	 $teneo_args = array(
					'post_type'        => 'school',
					'post_status'      => 'publish',
					'suppress_filters' => false,
					'posts_per_page'  => -1
					
	);
	
	
	 $tax_args = array();
	 $taxonomies_count = 0;	
	 
	 $go_school_link = site_url().'/our-schools/';
	
	if( isset($filters_arr['grade']) && $filters_arr['grade'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'grade',
            'field' => 'slug',
            'terms' => $filters_arr['grade']
       	 	);
			
		$go_school_link .= '?grade='.$filters_arr['grade'];	
	 }
	 
	 if( isset($filters_arr['language']) && $filters_arr['language'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'language',
            'field' => 'slug',
            'terms' => $filters_arr['language']
       	 	);
		
		$go_school_link .= '&language='.$filters_arr['language'];	
	 }
	 
	 if( isset($filters_arr['curriculum']) && $filters_arr['curriculum'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'curriculum',
            'field' => 'slug',
            'terms' => $filters_arr['curriculum']
       	 	);
			
		$go_school_link .= '&curriculum='.$filters_arr['curriculum'];		
	 }
	 
	 if( isset($filters_arr['examboard']) && $filters_arr['examboard'] !='' ) {
		$taxonomies_count++;	
	 		$tax_args[] = array(
            'taxonomy' => 'examination_board',
            'field' => 'slug',
            'terms' => $filters_arr['examboard']
       	 	);
			
		 $go_school_link .= '&examboard='.$filters_arr['examboard'];	
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
		

		
		foreach ($all_schools_array as $single_school) {
			$school_id = $single_school->ID;
			// setup_postdata( $school_id );
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
			
			$fee_flex_monthly_x12 = get_field('fee_flex_monthly_x12', $school_id);
			$fee_flex_termly_x4 = get_field('fee_flex_termly_x4', $school_id);
			$fee_flex_annual_x1 = get_field('fee_flex_annual_x1', $school_id);
			$fee_plus_monthly_x12 = get_field('fee_plus_monthly_x12', $school_id);
			$fee_plus_termly_x4 = get_field('fee_plus_termly_x4', $school_id);
			$fee_plus_annual_x1 = get_field('fee_plus_annual_x1', $school_id);
			
			
			$second_column_hex_color_style = $third_column_hex_color_style = '';
			$second_column_hex_color = get_field('2nd_column_hex_color', $school_id);
			$third_column_hex_color = get_field('3rd_column_hex_color', $school_id);
			
			if($second_column_hex_color != '') {
				$second_column_hex_color_style = 'style="background-color: '.$second_column_hex_color.'"';
			}
			
			if($third_column_hex_color != '') {
				$third_column_hex_color_style = 'style="background-color: '.$third_column_hex_color.'"';
			}	

	
	
	   
	   
	   
	   
	    /*2nd section fully start*/
			$html_content .= '<section class="container second-section py-3  mt-3 second-section-work" style="padding-left:unset;" >

      <div class="container border_hide_for_mobile px-lg-5 px-md-5 px-sm-3 py-3" style="background: #FEFDFC;border: 1px solid #D0E6F4;box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);border-radius: 10px;">
<div class="col-lg-12 mt-3"><h2>The FEES for you:</h2></div>

          <div class="row my-3 p-1">
              <div class="col-lg-8 col-md-8 col-sm-12 fees_title_tab" style="background: #21205A;
border-radius: 0px 49.4118px 49.4118px 0px;">
              <h4 class="text-bla text-white fs-3 py-2 px-2 ">
                  '.$school_title.'
              </h4>

              </div>
          </div>';
		  
		  
          
		  $layout_based_table_classes = '';
		  
		  if ($layout_type == 2) {
		  
		  $flex_per_month = $from_per_month;
		  
		  $layout_based_table_classes = '<div class="col-xl-4 col-lg-4 col-md-4 teacher-led-handle" >
                           					<div class="p-2 mb-0 bg-table-tag text-white text-center">Teacher-led real-time schools</div>
                        				 </div>
                             		 <div class="col-xl-8 col-lg-8 col-md-8" >';
									 
		  
		  
          $html_content .= '<div class="fee-tweenty fee-twenty-type-2">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <h1 class=fee-orange>2023 FEES</h1>
        </div>
        <div class="container">
          <div class="row py-5 align-items-start monthly  fee-month-type-2">
            <div class="col monthly-txt-type-2 monthly-text-m1">
              <h1><b>R'.$fee_flex_monthly_x12.'</b>  Monthly (x12)</h1>
              <h2 >Monthly Instalments <span class="span_bold" >(x12)</span> payments</h2>
              <span class="Payable payable-mobile">*Payablew in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span>
            </div>
            <div class="col  monthly-txt-type-2 monthly-text-m2 ">
              <h1><b>R'.$fee_flex_termly_x4.'</b> Termly (x4)</h1>
              <h2 >Termly Instalments <span class="span_bold" >(x4)</span></span> payments</h2>
              <span class="Payable  payable-mobile">*Payable in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span>
            </div>
            <div class="col   monthly-txt-type-2 monthly-text-m3">
              <h1><b>R'.$fee_flex_annual_x1.'</b>  Once Off (x1)</h1>
              <h2 >Annual Once-Off <span class="span_bold" >(x1)</span> payment</h2>
              <span class="Payable  payable-mobile"> *Payable in advance until R38,388 is paid in full,</span>
            </div>
          </div>

          <div  class="hold_type_2_module">
          <div class="fee-tweenty-thre priceify">
              
          <div class="col-lg-12  noteify">
              <h3 class="type_2_module_h3">PLEASE NOTE:</h3>
              
              <li>Additional International GCSE subjects are available at an extra cost of <b> R549 per subject per month.</b>   </li>
              <li>Sibling discounts are available  </li>
              <li>Fees exclude Pearson Edexcel examination International GCSE fees</li>
              <li>Tuition fees and examination fees are subject to changes and increases</li>
              <li>Should you decide to leave Teneo, one month’s notice is required</li>
                 
          </div>
          
    </div>

          <div class="accor">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item accor_type_2">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    We offer a sibling discount!
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">Receive an additional 5% discount for each sibling joining Teneo.</div>
                </div>
              </div>
            
              
            </div>
            </div>
            </div>
        </div>
        </div>

           
           
        <div class="row my-3 fees_box_handle_type_2"  >
                <div class="col-xl-6 col-lg-6 col-md-12  py-4 need-you fees_box_type_2">
                  <h5 class=" text-dark">Examination Board Fees</h5> 
                  <p class="text-dark ">For more information on additional examination board fees applicable to Grade 10 through 12, please download a comprehensive information pack containing details on subject choices and fees.</p> 
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12  py-4 need-you fees_box_type_2 fees_mbox_type_2">
                  <h5 class=" text-dark">All you need to know </h5> 
                  <p class="text-dark ">For all schools and grades - download an information pack now to see a complete overview on subjects.</p> 
                  <a href="http://enrolment.teneoschool.co.za/" ><button class="btn  rounded-pill  button-two-all-you-needs"> Enrol for 2023</button>  </a>
                  <a href="'.site_url().'/download-info-pack/" ><button class="btn  rounded-pill  button-one-all-you-need"><img class="img_adjust_blue" 
				  src="'.get_stylesheet_directory_uri().'/assets/images/FileArrowDownBlue.png" alt="">  Download the info pack </button> </a>
                </div>
              </div>';
	  
		  }
	  
	  
	   if ($layout_type == 3) {
		   
		   $layout_based_table_classes = '<div class="col-xl-8 col-lg-8 col-md-8" >
                           					<div class="p-2 mb-0 bg-table-tag text-white text-center">Teacher-led real-time schools</div>
                        				 </div>
                             		 <div class="col-xl-12 col-lg-12 col-md-12" >';
									 
        $html_content .= '<div class="container" id="three-columns-layout-fee-section">
          <div class="row align-items-start two-col">
            <div class="row g-0 real_time_plus_flex_row">
              <div class="col-lg-6 col-md-6 col-sm-12 real_time_plus_flex">
                <div class="fee-tweenty fee-q-filters">
                  <div class="fee-q-filter">
                    <h1 class="fee-yellow text-uppercase text-center">2023 Fees: REal-Time FLEX</h1> </div>
                  <div class="fee-tweenty-thre price">
                    <div class="monthly">
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_flex_monthly_x12.'</b> <span> Monthly (x12)</span></h1>
                        <h2 class="monthly-instalment">Monthly Instalments <b>(x12)</b> payments</h2> <span class="Payable">*Payablew in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span> </div>
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_flex_termly_x4.'</b> <span> Termly (x4)</span></h1>
                        <h2 class="monthly-instalment">Termly Instalments <b>(x4)</b> payments</h2> <span class="Payable">*Payable in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span> </div>
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_flex_annual_x1.'</b> <span> Once Off (x1)</span></h1>
                        <h2 class="monthly-instalment">Annual Once-Off <b>(x1)</b> payment</h2> <span class="Payable monthly-q-payale"> *Payable in advance until R38,388 is paid in full,</span> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 real_time_plus_flex"">
                <div class="fee-tweenty fee-q-filters">
                  <div class="fee-q-filter fee-q-filters_plus">
                    <h1 class="fee-yellow text-uppercase text-center">2023 Fees: REal-Time Plus</h1> </div>
                  <div class="fee-tweenty-thre price">
                    <div class="monthly">
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_plus_monthly_x12.'</b> <span> Monthly (x12)</span></h1>
                        <h2 class="monthly-instalment">Monthly Instalments <b>(x12)</b> payments</h2> <span class="Payable">*Payablew in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span> </div>
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_plus_termly_x4.'</b> <span> Termly (x4)</span></h1>
                        <h2 class="monthly-instalment">Termly Instalments <b>(x4)</b> payments</h2> <span class="Payable">*Payable in advance until R38,388 is paid in full, from the time of enrolment to the end of November 2023.</span> </div>
                      <div class="monthly-txt1">
                        <h1><b>R'.$fee_plus_annual_x1.'</b> <span> Once Off (x1)</span></h1>
                        <h2 class="monthly-instalment">Annual Once-Off <b>(x1)</b> payment</h2> <span class="Payable monthly-q-payale"> *Payable in advance until R38,388 is paid in full,</span> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
         
        
        </div>


        
        <div  class="hold_type_2_module">
          <div class="fee-tweenty-thre price">
              

              <div class="col-lg-12 mt-3 note">
                  <h3>PLEASE NOTE:</h3>
                  <li>Sibling discounts are available  </li>
                  <li>
                   Fees exclude examination board fees for Grades 10, 11, 12 
                  </li>
                  <li>Tuition fees and examination fees are subject to changes and increases
                  </li>
                  <li>Should you decide to leave Teneo, one month’s notice is required</li>
                      
              </div>
              
        </div>
          
            <div class="accor">
              <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                      We offer a sibling discount!
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Receive an additional 5% discount for each sibling joining Teneo.</div>
                  </div>
                </div>
              
                
              </div>
              </div>
          </div>
           
              <div class="row my-3 fees_box_handle"  >
                <div class="col-xl-6 col-lg-6 col-md-12  py-4 need-you fees_upper_box">
                  <h5 class=" text-dark">Examination Board Fees</h5> 
                  <p class="text-dark ">For more information on additional examination board fees applicable to Grade 10 through 12, please download a comprehensive information pack containing details on subject choices and fees.</p> 
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12  py-4 need-you fees_lower_box"">
                  <h5 class=" text-dark">All you need to know </h5> 
                  <p class="text-dark ">For all schools and grades - download an information pack now to see a complete overview on subjects.</p> 
                  <a href="http://enrolment.teneoschool.co.za/" ><button class="btn  rounded-pill  button-two-all-you-needs"> Enrol for 2023</button>  </a>
                  <a href="'.site_url().'/download-info-pack/" ><button class="btn  rounded-pill  button-one-all-you-need"><img class="img_adjust_blue" 
				  src="'.get_stylesheet_directory_uri().'/assets/images/FileArrowDownBlue.png" alt="">  Download the info pack </button> </a>
                </div>
              </div>
          
          </div>
         
     ';
	 
	   }
	 
	 
	 
	 
	 /*2nd section fully end*/
	$html_content .= '
  </section>';

  
  
	      
		
		
		$table_style_hide = ' display:none';
			if( have_rows('what_you_get', $school_id) ) {
				
				 $table_style_hide = '';
			       
				// Loop through rows.
				$heading_html = $flex_html = $plus_html = $table_rows_html = $third_column_plus_th_header = $last_td_plus = $mobile_plus_flex_btn = '' ;
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
                                          <div class=" text-uppercase heading-real-time"  >real-time</div>
                                       </div>
                                       <div class="col-lg-4 col-md-4 col-sm-12 ">
                                          <h2  class="table_flex_head" >'.$third_column_right_title.'</h2>
                                       </div>
                                       <p class="table_flex_pra">R '.$plus_per_month.' monthly</p>
                                      </div>
                                     </div>
                                    </th>';
									
					   $plus_html = '<td class="table-plus-col" >'.$sub_real_time_plus.'</td>';	
					   $last_td_plus = '<td class="table-plus-col"><a href="'.$go_school_link.'"><button class="btn_td_school_right" >Take me to schools</button></a></td>';
					   
					   $mobile_plus_flex_btn = '<div class="mobile-plus-flex-buttons">
                         <button class="mobile-flex-button active_btn_tab_mob" id="flex-jquery-btn">  FLEX </button>
                       <button class="mobile-plus-button" id="plus-jquery-btn" > PLUS </button></div>';
										
					 }
									
					
					

          	// attiq test Load sub field value.
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
                              
                       
                         <div class="col-xl-4 col-lg-4 col-md-4  real-teacher-empthy" >                       
                          </div>
                        
						'.$layout_based_table_classes.'
						
                             <div class="horizontal-scroll-except-first-column">

                               <table class="table table-stripeding table_maintiance" > 
                                <thead>
                                  <tr>
                                   <th scope="col"  class="table-first-heading">
                                    <div class="grade-heading-columns" id="heading-1">
                                      <div class="row table_top_head" id="heading-11">
                                        <h2 >'.$grade_level_1st_column.'</h2>
                                        <p id="heading-101" >How do they compare?</p>
                                      </div>
                                    </div>  
                                   </th>

                                   <th scope="col" class="table-flex-heading" '.$second_column_hex_color_style.' >
                                    <div class="grade-heading-column" >
                                      <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12  ">
                                          <div class=" text-uppercase heading-real-time" >real-time</div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 ">
                                          <h2 class="table_flex_head" > '.$second_column_left_title.'</h2>    
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
                                      <td class="table-flex-col"  ><a href="'.$go_school_link.'"><button class="btn_td_school_left" >Take me to schools</button></a></td>
									  '.$last_td_plus.'
                                     </tr>
                                   </tbody>
                                 </table>
                               </div>
                             </div>  
                           </div>    

                           

                                   
                                

                           <div class="row py-4 table-last-buttons-one">
                             <div class="	col-xl-5  col-lg-7 py-2">
                               <a href="'.site_url().'/download-info-pack/" ><button class="btn w-100  rounded-pill pil_btn" > 
							   <img src="'.get_stylesheet_directory_uri().'/assets/images/FileArrowDown.png" alt=""> Download the comprehensive info pack</button></a>
                             </div>
                             <div class="col-xl-4 col-lg-5 py-2" >
                               <a href="http://enrolment.teneoschool.co.za/" ><button class="btn w-75  rounded-pill pil_btn_enroll"> Enrol now for 2023!</button></a>
                             </div>
                             <p class="py-3">Looking for parent led schooling? <a href="#" class="click_btn_filter" ><u>Click here</u></a> Have a look at our Homeschooling option &nbsp; &nbsp;<img src="'.get_stylesheet_directory_uri().'/assets/images/ArrowRight.png" alt=""></p>
                          </div>

  </div>  
                
</section>';
            
            
			
		} // loop end
		
		
		
		$html_content .= '<section class=" container">
<div class="row table-last-buttons-two">
                  <div class="col-sm-12 py-2 text-center d-flex flex-column">
                  
                     <a href="'.$all_you_need_know_link.'" > <button class="btn   rounded-pill button-one-last" style="background: #F9ED32;
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