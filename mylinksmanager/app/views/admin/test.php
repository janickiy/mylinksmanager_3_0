<?php
$insert = "INSERT INTO referats (`id`, `theme`, `part`, `who`, `add_date`, `about`, `downloads`, `type`, `keywords`, `description`, `status`, `qip_download_link`, `translit_theme`, `editor_desc`, `file_size`, `counter`)
VALUES (0,
'" . $row['theme'] . "',
'" . $row['part'] . "',
2,
NOW(),
'" . $row['about'] . "',
0,
" . $row['type'] . ",
'" . $row['keywords'] . "',
'" . $row['description'] . "',
2,
'" . $qip_download_link . "',
'" . $translit_theme . "',
'" . $row['editor_desc'] . "',
'" . $row['file_size'] . "',
0)";