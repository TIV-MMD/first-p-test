<?php

// echo implode('-', $tasks) . '<br>';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= SITE_TTITLE ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://kit.fontawesome.com/2f8e275965.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel"><a href="<?= site_url("?logout=1") ?>"><i class="fa-solid fa-right-from-bracket"></i></a> <span class="username"><?= getLogInedUser()->name ?? 'Unknown' ?></span><img
          src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40" /></div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">Folders</div>
          <ul class="folders-list">
            <li
              class="<?=(!isset($_GET['folder_id'])) ? 'active' : '' ?>">
              <a href="<?= site_url() ?>"> <i class="fa fa-folder"></i>All</a> </li>
            <?php foreach ($folders as $folder):  ?>
            <li
              class="<?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'active' : '' ?>">
              <a href="?folder_id=<?php echo $folder->id ?>"><i
                  class="fa-solid fa-folder"></i><?php echo $folder->name ?></a>
              <a href="?delet_folder=<?php echo $folder->id ?>"
                onclick="return confirm('are you sure to delete this folder')"><i class="fa-solid fa-trash"></i></a>
            </li>
            <?php endforeach; ?>

          </ul>
        </div>
        <div>
          <input type="text" id="addFolderInput" style="width: 65%; margin-left: 8%;" placeholder="Add New Folder" />
          <button id="addFolderBtn" class="btn clickable">+</button>
        </div>
      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title" style="width: 50%;">
            <input type="text" id="addTaskNameInput" style="width: 100%; margin-left:3%; line-height:30px"
              placeholder="Add New Task">
            <!-- <button id="addTaskBtn" class="btn clickable">+</button> -->
          </div>

          <div class="functions">
            <div class="button active">Add New Task</div>
            <div class="button">Completed</div>
            <div class="button inverz"><i class="fa fa-trash-o"></i></div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <!-- <div class="title">Today</div> -->
            <ul>
              <?php if (sizeof($tasks) > 0):?>
              <?php foreach ($tasks as $task):  ?> 
              <li
                class="<?= $task->is_done ? 'checked' : ''; ?>">
                <i
                  data-taskId="<?= $task->id ?>" class="isDone clickable <?=$task->is_done ? 'fa fa-check-square-o' : 'fa fa-square-o';?> "></i>
                <span><?= $task->title ?></span>
                <div class="info">
                  <span class="created-at">Created At
                    <?= $task->created_at ?> </span>
                  <a href="?delet_task=<?= $task->id?>"><i
                      class="fa-solid fa-trash"
                      onclick="return confirm('are you sure to delete this task?: \n <?= $task->title ?>')"></i></a>
                </div>
              </li>
              <?php endforeach; ?>
              <?php else: ?>
              <li>no task here...</li>
              <?php endif ?>

            </ul>
          </div>
          <!-- <div class="list">
            <div class="title">Tomorrow</div>
            <ul>

            </ul>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="assets/js/script.js"></script>
  <script>
    $(document).ready(function() {

      $('.isDone').click(function(e){
          var tid = $(this).attr('data-taskId');
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            data : {action: "doneSwitch",taskId : tid},
            success : function(response){
                location.reload();
                var res = JSON.parse(response);
                if (res.status == 1) {
                  location.reload();
                } else {
                  alert(res.message)
                }

            }
            
          });
      });




      $('#addFolderBtn').click(function(e) {
        var input = $('input#addFolderInput');
        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "addFolder",
            folderName: input.val(),

          },
          success: function(response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
              //<li> <a href="?folder_id=10"><i class="fa-solid fa-folder"></i>vvv</a> <a href="?delet_folder=10"><i class="fa-solid fa-trash"></i></a> </li>
              $('<li> <a href="?folder_id=' + res.id + '"><i class="fa-solid fa-folder"></i>' + input
                .val() + '</a> <a href="?delet_folder=' + res.id +
                '"><i class="fa-solid fa-trash"></i></a> </li>').appendTo('ul.folders-list');
            } else {
              alert(response)
            }

          }
        });
      });

      $('#addTaskNameInput').on('keypress',function(e){
        if(e.which==13){

          $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
              action: "addTask",
              folderId : <?=$_GET['folder_id'] ?? 0 ?>,
              taskTitle: $('#addTaskNameInput').val()
            },
            success: function(response) {

              var res = JSON.parse(response);
              if (res.status == 1) {
                location.reload();
              } else {
                alert(res.message)
              }

            }
          });
        }
      });
      });

    
  </script>
</body>

</html>