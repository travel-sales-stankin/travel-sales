<?php
	if (isset($_POST['getData'])) {
		$conn = new mysqli('localhost', 'id11860944_admin', '12345', 'id11860944_actions');

		$start = $conn->real_escape_string($_POST['start']);
		$limit = $conn->real_escape_string($_POST['limit']);
	
	
		
		if($_POST['mode'] == 1){
			$q_select = "SELECT link,img,name,start,p_desc FROM actions WHERE p_group IS NULL or p_group = 'Одобрено' order by id desc LIMIT $start, $limit ;";
		} else {
		    
			$q_select = "SELECT link,img,name,start,p_desc FROM actions WHERE p_group IS NULL or p_group = 'Одобрено' LIMIT $start, $limit ;";
		    
		}

		$sql = $conn->query($q_select);
		if ($sql->num_rows > 0) {
			$response = "";

			while($data = $sql->fetch_array()) {
				$response .= '
				<div class="col-md-4">
				<div class="card mb-4 box-shadow">
                <a href = "'.$data['link'].'"><img class="card-img-top" src="'.$data['img'].'" alt="Card image cap"></a>
                <div class="card-body">
                <h5 class="card-title">'.$data['name'].'</h5>
                <p class="card-text">'.$data['p_desc'].'</p>
                <p class="card-text"><small class="text-muted">'.$data['start'].'</small></p>
             </div>
            </div>
            </div>
				
				';
			}

			exit($response);
		} else
			exit('reachedMax');
	}
	
?>