<?php
function includes($file_path){
    if (file_exists($file_path) && is_file($file_path)) {
        return include $file_path;
    }

    return '';
}

function page($path, $page, $border = false) {
  if ($path == $page) {
      if (file_exists($page) && is_file($page)) {
          if ($border) {
              return 'border-left: 5px solid var(--li-text-color-hover);';
          }
          return 'color: var(--li-text-color-hover);';
      }
  }

  return '';
}

class Page {
    // Step 1: Declare a static variable to hold the instance of the class
    private static $instance = null;

    // Step 2: Declare a private property to store the page filename
    private $page;

    // Step 3: Private constructor to prevent direct instantiation
    private function __construct() {
        // Set the page filename when the object is created
        $this->page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
    }

    // Step 4: Public static method to get the single instance of the class
    public static function getInstance() {
        // Check if the instance doesn't exist and create it
        if (self::$instance === null) {
            self::$instance = new Page();
        }
        // Return the instance
        return self::$instance;
    }

    // Step 5: Getter method to access the page filename
    public function getPage() {
        return $this->page;
    }
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