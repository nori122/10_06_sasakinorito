<!---------------------
     php 要素
--------------------->


<?php
session_start();
// sessionをスタートしてidを再生成しよう．
// 旧idと新idを表示しよう．


$old_session_id = session_id();

session_regenerate_id(true);

$new_session_id = session_id();

echo '<p>旧id' . $old_session_id . '</p>';
echo '<p>新id' . $new_session_id . '</p>';
