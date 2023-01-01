<?php 				
					//fetch grades
					$grades_args = array("hide_empty" => 0,
                    "type"      => "school",
					"taxonomy"      => "grade",       
                    "orderby"   => "id",
                    "order"     => "ASC" );
					$all_grades = get_categories($grades_args); 
					
					//fetch language
					$language_args = array("hide_empty" => 0,
                    "type"      => "school",
					"taxonomy"      => "language",       
                    "orderby"   => "id",
                    "order"     => "ASC" );
					$all_languages = get_categories($language_args); 
					
					//fetch curriculum
					$curriculum_args = array("hide_empty" => 0,
                    "type"      => "school",
					"taxonomy"      => "curriculum",       
                    "orderby"   => "id",
                    "order"     => "ASC" );
					$all_curriculums = get_categories($curriculum_args);
					
					//fetch examination_boards
					$examination_board_args = array("hide_empty" => 0,
                    "type"      => "school",
					"taxonomy"      => "examination_board",       
                    "orderby"   => "id",
                    "order"     => "ASC" );
					$all_examination_boards = get_categories($examination_board_args); 
	
	
	
					// checking data from query strings to auto populate filters
					$curr_grade = $curr_language = $curr_curriculum = $curr_examboard = '';
					if ( isset($_GET['grade']) && $_GET['grade'] != '' ){
						$curr_grade = $_GET['grade'];
					}
					if ( isset($_GET['language']) && $_GET['language'] != '' ){
						$curr_language = $_GET['language'];
					}
					if ( isset($_GET['curriculum']) && $_GET['curriculum'] != '' ){
						$curr_curriculum = $_GET['curriculum'];
					}
					if ( isset($_GET['examboard']) && $_GET['examboard'] != '' ){
						$curr_examboard = $_GET['examboard'];
					}
					
					
					
	?>
    
<section Class="fist-section-filter">
    <div class="container mt-5 pt-1 p-5 first-main-container">
      <form action="" method="" id="school_search_form">
        <div class="row section-one mt-5 p-3">
            <div class="col-lg-12 col-md-12 col-sm-12 first-row-texts mt-2" >
                <h4 class=" text-white">Find the school solution that’s right for you</h4>
                <h6 class="pt-2 text-white">And we’ll provide an information pack detailing available subjects  </h6>
            </div>
        </div>
        <div class="row row-two">
            <div id="schools-ajax-loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i> Loading</div>
            <div class="col-lg-3 col-md-5 col-sm-12 py-sm-3 py-3">
                <p class="pb-sm-0" >Select your grade:</p>
                <div class="select-Second-rows">
                    <select id="grade" name="grade" class="form-select select_data grade grade_filter">
                      <option value="">Select Grade</option>
                     <?php  foreach($all_grades as $grade){
						    $selected = '';
							if($curr_grade == $grade->slug) {
								$selected = 'selected';
							}
						echo "<option value=".$grade->slug." ".$selected.">".$grade->name."</option>";
					 }?>
                    </select>
                   
                 </div>
                  
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12 py-sm-3 py-3">
                <p>Select your language of instruction:</p>
                <div class="select-Second-rows" >
                 <select id="subject" name="language" class="form-select select_data school_language language_filter">
                       <option value="">Select Language</option>
                       <?php  foreach($all_languages as $language){
						   $selected = '';
							if($curr_language == $language->slug) {
								$selected = 'selected';
							}
						echo "<option value=".$language->slug." ".$selected.">".$language->name."</option>";
					
					}?>    
                    </select>
            </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mt-4 d-none d-md-block">
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <div class=" text-center filter-button" style="border: 1px solid #D0E6F4;
                      
                        box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);
                        border-radius: 5px; width: 60%;">
                        <a  href="#" class="fs-5 reset_school_search" style="text-decoration:underline; color: #3934A9; font-size:20px; font-weight:600;    font-family: 'Montserrat';" >Reset filters <img style="padding-left: 5px;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Frame 4826.png" alt=""></a>
                            
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        
        <?php
		$curriculum_style_hide = '';
		if($curr_curriculum == '') {
		  $curriculum_style_hide = 'style="display:none;"';
		}
		 ?>

        <div class="row section-one-last-row curriculum_section" <?php echo $curriculum_style_hide; ?>>
            <!-- Choose a grade radio Button -->
            <div class="col-12">
                <h6 class="mb-4" >Select a curriculum:</h6>
                <div>
                 <?php  foreach($all_curriculums as $curriculum){ 
				             $checked = '';
							if($curr_curriculum == $curriculum->slug) {
								$checked = 'checked';
							}
				 
				  ?>
						 <div class="form-check mb-3">
                      <input type="radio" class="form-check-input curriculum_filter" id="<?php echo $curriculum->slug; ?>" name="curriculum" value="<?php echo $curriculum->slug; ?>" <?php echo $checked; ?> >
                      <label class="form-check-label" for="<?php echo $curriculum->slug; ?>"><?php echo $curriculum->name; ?></label>
                    </div>
				<?php } ?>
                    
               </div>
            </div>

        </div>
        
        
           <!-- Choose a Board Radio button -->
            
         <?php
		$exam_style_hide = '';
		if($curr_examboard == '') {
		  $exam_style_hide = 'style="display:none;"';
		}
		
		if($curr_grade == 'adult-matric' && $curr_language != '') {
		  echo '<style> div.examination_board_22, div.examination_board_24 { display: none; } </style>';
		} else {
		
			if($curr_examboard != '' && $curr_language == 'afrikaans') {
			  echo '<style> div.examination_board_24 { display: none; } </style>';
			}
			
			if($curr_examboard != '' && $curr_language == 'english') {
				if($curr_curriculum == 'south-african') {
					echo '<style> div.examination_board_24 { display: none; } </style>';
				}
				if($curr_curriculum == 'british-international') {
					echo '<style> div.examination_board_22, div.examination_board_23 { display: none; } </style>';
				}
			  
			}
		
		}
		
		
		
		 ?>
           
           <div class="row section-one-last-row examination_board_section" <?php echo $exam_style_hide; ?>>
            <div class="col-lg-12 mt-3">
                <h6 >Choose an examination board:</h6>
                <div class=" radio-card-button d-flex mt-3">
                <?php  foreach($all_examination_boards as $examination_board){ 
				            $checked = '';
							if($curr_examboard == $examination_board->slug) {
								$checked = 'checked';
							}
				
				?>
                    <div class="form-check flex-column mb-2 examination_board_<?php echo $examination_board->term_id; ?>" style="margin-right: 30px; width: 310px; border: 1px solid ; padding-left: unset; border-radius: 10px; box-shadow: 0px 2px 20px 0px rgba(0, 0, 0, 0.2);
                    ">
                      <input type="radio" class="form-check-input radio-card examboard_filter" id="<?php echo $examination_board->term_id; ?>" name="examboard" value="<?php echo $examination_board->slug; ?>" <?php echo $checked; ?> style="position: relative;
                      left: 40px; top: 10px; width:24px; height:24px; ">
                        
                      <div class=" text-center">
                       <?php $examination_board_image = get_field('examination_board_image', 'examination_board' . '_' . $examination_board->term_id); ?>
                        <img class="mt-3" src="<?php echo $examination_board_image;?>" alt="" style="">  
                        <label class="form-check-label mt-3 text-center" style="padding-top: 10px;"><?php echo $examination_board->name; ?></label>
                        <p class="text-start" style="line-height:color:27.2px;  color:#16243E; text-align:center !important; font-size:14px; font-weight:400; font-family:Montserrat; padding: 18px;"><?php echo $examination_board->description; ?></p>
                      </div>
                      
                    </div>
				<?php	}?> 
              </div>

            </div>
           </div>
            

                  <div class=" after-select-option-text-mob mt-4">
                    <p class="py-2 " style="display:none"><a href="#">Swipe to see all schools</a>  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ArrowRight.png" alt=""></p>
                    <button id="find_my_school_btn" class="btn rounded-pill button-one-last mt-3" style="background: #16243E; box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);color: #ffffff;  width:100% !important; margin-bottom:20px;" type="button"> Find my school!
                    </button>

                  </div>  
                  
                  <div class="col-sm-12 mt-4 d-block d-md-none">
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <div class=" text-center filter-button" style="border: 1px solid #D0E6F4;
                              
                                box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.25);
                                border-radius: 5px; width: 60%;">
                                <a  href="#" class="fs-5 reset_school_search" style="text-decoration:underline; color: #3934A9; font-size:20px; font-weight:600;    font-family: 'Montserrat';" >Reset filters <img style="padding-left: 5px;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Frame 4826.png" alt=""></a>
                                    
                                </div>
                            </div>
        
                        </div>
                
               </div>
                  
                  
                  <input type="hidden" name="filters_type" id="filters_type" value="schools"  />
                  <input type="hidden" name="filters_page_url" id="filters_page_url" value="<?php echo get_permalink( 147 ); ?>"  />

</form>
        
    </div>
</section>



<style>


@media only screen and (max-width: 767px) {
  .what_you_get_plus {
	  display:none !important;
  }
}


</style>

<div id="all-schools-fees-listing-section"> 

<?php 

$filters_arr = array();
if ( $curr_grade != '' ){
	$filters_arr['grade'] = $curr_grade;
}
if ( $curr_language != '' ){
	$filters_arr['language'] = $curr_language;
}
if ( $curr_curriculum != '' ){
	$filters_arr['curriculum'] = $curr_curriculum;
}
if ( $curr_examboard != '' ){
	$filters_arr['examboard'] = $curr_examboard;
}

if(count ($filters_arr) > 1) {
	
	$schools_html = get_schools_listing_html_data($filters_arr);
	echo $schools_html;
}


?>

</div>