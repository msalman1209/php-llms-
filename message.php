<?php

if (isset($_SESSION['toastmsg'])) {
    $message = json_decode($_SESSION['toastmsg']);
?>
<script>
iziToast.<?php echo $message->type; ?>({
    title: '<?php echo $message->cssClass; ?>',
    message: '<?php echo $message->content; ?>',
    position: 'topRight'
});
</script>
<?php
    unset($_SESSION['toastmsg']);
}
if (isset($_SESSION['sweetmsg'])) {
    $message = json_decode($_SESSION['sweetmsg']);
?>
<script>
swal('<?php echo $message->type; ?>', '<?php echo $message->content; ?>', '<?php echo $message->cssClass; ?>');
</script>
<?php
    unset($_SESSION['sweetmsg']);
}