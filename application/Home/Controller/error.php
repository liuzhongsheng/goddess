<html>
    <head></head>
    <body>
        <h3>系统发生错误</h3>
        <p><span>错误文件: </span><?php echo $e['file'];?></p>
        <p><span>错误位置: </span><?php echo $e['line'];?></p>
        <p><span>错误提示: </span><?php echo $e['message'];?></p>
    </body>
</html>