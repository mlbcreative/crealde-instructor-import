<?php
	
	class ProClassInstructorImport {
		
		
		private $msg;
		private $instructorid = "";
		
		public function __construct($id) {
			$this->instructorid = $id;
		}
		
		
		
		public function fetchInstructor() {
						
			$username = 'CrealdeApi';
			$password = 'U9bW!2oRR';
			$url = 'https://api112.imperisoft.com/api/Instructors/' . $this->instructorid;
			$args = array(
			    'headers' => array(
			        'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password )
			    )
			);
			
			//echo $url;
			
			$request = $request = wp_remote_request( $url, $args );
	
	
	
			if( is_wp_error( $request ) ) {
				$error =  "Ooops. Something happened. Try importing again.";
				return $error; // Bail early
			} else {
				
				$body = wp_remote_retrieve_body( $request );
		
				$data = json_decode( $body );
				

				$this->parseInstructor($data);
				
			}
			
		}
		
		
		private function parseInstructor($data) {
			
			
			$newInstructor = $data;
			

						
			if (!empty( $data )) {
					
					if ($newInstructor->IsActive != true ) :

						$msg =  "This instructor is not currently active. Only active instructors will can be imported.";
						echo $msg;
						return;
					endif;


						
					$args = array(
					    'post_title'    => $newInstructor->Contact->FirstName . ' ' . $newInstructor->Contact->LastName,
					    'post_content'  => $newInstructor->Bio,
					    'post_type'     => 'instructor',
					    'post_status'   => 'draft'
					  );
					
					if( $args['post_content'] == null ) {
						$args['post_content'] = "Instructor bio coming soon.";
					}


					$post = wp_insert_post($args, true);
					
					//update the custom fields
					//var_dump($post);

					

					update_field( 'instructor_image', $newInstructor->ImageUrl, $post );
					update_field( 'instructor_id', $newInstructor->InstructorId, $post );
					update_field( 'instructor_email', $newInstructor->Contact->Email, $post );
					update_field( 'instructor_type', $newInstructor->InstructorType->Description, $post );
					//update_field( 'instructor_type', $newInstructor->InstructorType->Description, $post );
					
			
					
				$msg = $newInstructor->Contact->FirstName . ' ' . $newInstructor->Contact->LastName . " has been imported.";
				echo $msg;
				return;
			}
		}
		
		private function parseInstructors($data) {
			
			$names = "";
			
			//let's see if any existing instructors are in the system
			
			$args = array(
				'post_type' => 'instructor',	
				
			);
			
			$existing = get_posts($args);
			
			if(  empty( $data ) ) {
				echo "Instructor data could not be retrieved from ProClass";
				return;
			}
			
			
			//
			if( ! empty( $data ) && count( $existing ) == 0 ) {
			
				foreach($data as $key => $instructor) {
					
					if($instructor->Contact->IsActive) :
					
					$instructor_post = array(
					    'post_title'    => $instructor->Contact->FirstName . ' ' . $instructor->Contact->LastName,
					    'post_content'  => $instructor->Bio,
					    'post_type'     => 'instructor',
					    'post_status'   => 'publish'
					  );
					
					$instructor_id = wp_insert_post($instructor_post);
					
					//update the custom fields
					
					
					update_field( 'instructor_image', $instructor->ImageUrl, $instructor_id );
					update_field( 'instructor_id', $instructor->InstructorId, $instructor_id );
					update_field( 'instructor_email', $instructor->Contact->Email, $instructor_id );
					
					endif;
					
					}//end foreach
			
				//echo "All instructors have been imported.";
				$msg = "All instructors have been imported.";
				return $msg;
			}
			
			
			//update the posts if the instructor already exists
			
			if( ! empty( $data ) ) {
				
								
				foreach ($data as $key => $instructor) {
					
					if($instructor->Contact->IsActive) :
					
					$queryargs = array(
						'post_per_page' => -1,
						'post_type' => 'instructor',
						'meta_field' => 'instructor_id',
						'meta_value' => $instructor->InstructorId,
					);
					
					$post = get_posts($queryargs);
					
					
					$new_post  = array(
						'ID' => $post[0]->ID,
						'post_title'    => $instructor->Contact->FirstName . ' ' . $instructor->Contact->LastName,
					    'post_content'  => $instructor->Bio,
					);
					
					$instructor_id = wp_update_post($new_post);
					
					//update custom fields
					update_field( 'instructor_image', $instructor->ImageUrl, $instructor_id );
					update_field( 'instructor_id', $instructor->InstructorId, $instructor_id );
					update_field( 'instructor_email', $instructor->Contact->Email, $instructor_id );
					
					endif;
				}
				
				
				
				echo "All instructors have been updated.";
				return;//get out			
			}
			
			
		}
		
		
		
	}