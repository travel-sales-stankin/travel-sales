<?php
	if (isset($_POST['key'])) {

	$conn = new mysqli('localhost', 'id11860944_admin', '12345', 'id11860944_actions');

		if ($_POST['key'] == 'getRowData') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  name, link,img,p_desc,start,p_group FROM actions WHERE id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
				'Name' => $data['name'],
				'p_link' => $data['link'],
				'p_start' => $data['start'],
				'p_img' => $data['img'],
				'p_desc' => $data['p_desc'],
				'p_group' => $data['p_group']
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT id, name, p_group FROM actions LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["id"].'</td>
							<td id="country_'.$data["id"].'">'.$data["name"].'</td>
							<td>'.$data["p_group"].'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data["id"].', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="viewORedit('.$data["id"].', \'view\')" value="View" class="btn">
								<input type="button" onclick="deleteRow('.$data["id"].')" value="Delete" class="btn btn-danger">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRow') {
			$conn->query("DELETE FROM actions WHERE id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		$name = $conn->real_escape_string($_POST['name']);
		$p_link = $conn->real_escape_string($_POST['p_link']);
		$p_img = $conn->real_escape_string($_POST['p_img']);
		$p_start = $conn->real_escape_string($_POST['p_start']);
		$p_desc = $conn->real_escape_string($_POST['p_desc']);
		$p_group = $conn->real_escape_string($_POST['p_group']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE actions SET name='$name', link='$p_link', img='$p_img', start = '$p_start', p_desc ='$p_desc', p_group = '$p_group' WHERE id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT id FROM actions WHERE name = '$name'");
			if ($sql->num_rows > 0)
				exit("Sale With This Name Already Exists!");
			else {
				$conn->query("INSERT INTO actions (name, link, img, start, p_desc,p_group) 
							VALUES ('$name', '$p_link', '$p_img','$p_start','$p_desc','$p_group')");
				exit('Sale Has Been Inserted!');
			}
		}
		if ($_POST['key'] == 'addOffer') {
		    //$p_group = $conn->real_escape_string($_POST['p_group']);
			$sql = $conn->query("SELECT id FROM actions WHERE name = '$name'");
			if ($sql->num_rows > 0)
				exit("Sale With This Name Already Exists!");
			else {
				$conn->query("INSERT INTO actions (name, link, p_group, start, p_desc) 
							VALUES ('$name', '$p_link', 1,'$p_start','$p_desc')");
				exit('Ваше предложение добавлено');
			}
		}
	}
?>