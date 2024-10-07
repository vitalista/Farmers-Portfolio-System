<?php
function includes($file_path){
    if (file_exists($file_path) && is_file($file_path)) {
        return include $file_path;
    }

    return 'This is a file.';
}
?>
<script>
    const entryFade = (card) => {
      card.setAttribute('data-aos', 'fade-out');
      card.setAttribute('data-aos-duration', '500');
    }

    const removalFade = (card) => {
      card.style.opacity = '1';
      card.style.transition = 'opacity 0.5s ease';
      card.style.opacity = '0';
    }
</script>