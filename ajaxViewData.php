<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
$servername = "localhost";
$database = "complaintsci";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$current_page = isset($_POST['page_current']) ? $_POST['page_current'] : 1;

$where = ' where 1 = 1 ';
$where .= isset($_POST['data']) ? ' and video_manager.group_id = '.$_POST['data'].' ' : '';
$where .= isset($_POST['lang']) ? ' and video_manager.lang = "'.$_POST['lang'].'"': '';

echo $current_page;

$sqll = "SELECT video_manager.id, video_manager.youtube_link, video_manager.note, video_manager.user_create, video_manager.date_create,video_manager.group_id,video_group.name   
FROM video_manager JOIN video_group ON video_group.id = video_manager.group_id".$where;
echo $sqll;
$result = mysqli_query($conn, $sqll);
$rowcount = mysqli_num_rows($result);

$result = mysqli_query($conn, "SELECT count(video_manager.id) as total FROM video_manager JOIN video_group ON video_group.id = video_manager.group_id".$where);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

// $current_page = isset($_POST['page_current']) ? $_POST['page_current'] : 1;
// echo $_POST['page_current'];
$limit = 9;

// BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

// BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
// Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
$result = $sqll . "LIMIT $start, $limit";
echo $result;
$result_page = $conn->query($result);
$chuoi = "";
$chuoi .= "<ul class='columns-3 wp-block-post-template is-layout-grid wp-container-core-post-template-layout-1 wp-block-post-template-is-layout-grid'>";
while ($row = $result_page->fetch_assoc()) {
    $src = "https://img.youtube.com/vi/" . $row['youtube_link'] . "/maxresdefault.jpg";
    $id = '"' . $row['youtube_link'] . '"';
    $chuoi .= "<li
    class='wp-block-post post-21 post type-post status-publish format-standard has-post-thumbnail hentry category-travel'>
    <div class='wp-block-group is-layout-flow wp-block-group-is-layout-flow custom_play_button'
        style='padding-top:0px;padding-right:0px;padding-bottom:5px;padding-left:0px'><button class='btn p-0 js-play'
            type='button' data-toggle='modal' onclick='setVideo(" . $id . ")' data-target='#modalVideo'data-title='Video Play'><img class='card-img-top' src='$src' alt='Video Play' /><i style='color: red' class='fab fa-youtube'></i></button>
            
    </div>
    <button class='btn p-0 js-play button_contact' type='button' data-toggle='modal' data-target='#modalContact'data-title='Video Play'>Contact Us</button>
</li>";
}
$chuoi .= "</ul>";
$chuoi .= "<ul class='page_ud'>";
if ($current_page > 1 && $total_page > 1) {
    $chuoi .= '<a onclick=page_tion(' . ($current_page - 1) . ')>Prev</a>';
}
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $current_page) {
        $chuoi .= '<span>' . $i . '</span>';
    } else {
        $chuoi .= '<a onclick=page_tion(' . $i . ')>' . $i . '</a>';
    }
}
if ($current_page < $total_page && $total_page > 1) {
    $chuoi .= '<a onclick=page_tion(' . ($current_page + 1) . ')>Next</a>';
}
$chuoi .= "</ul>";

echo $chuoi;
?>