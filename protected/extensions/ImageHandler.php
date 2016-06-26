<?php

Yii::import("application.extensions.thumbnailer.ThumbLib_inc", true);

class ImageHandler {

    public $dirProducts = 'documents/timeline/';
    public $imageExt = array('jpg', 'png', 'gif');
    public $flashExt = array('swf');
    public $sizeDefault = array('x' => 1095, 'y' => 523);
    public $sizeThumb = array('x' => 361, 'y' => 300);
    public $flashWidth = 1160;
    public $flashHight = 385;
    public $link = '#';
    public $id = '';
    public $alt = '';
    public $quality = 'medium'; // best,thumb, medium

    public function CreateDirProdImage($sku = '') {
        $dirDest = $this->dirProducts . str_replace('/', '', $sku);
        if (!file_exists($dirDest)) {
            mkdir($dirDest, 0777);
            mkdir($dirDest . '/thumb', 0777);
            mkdir($dirDest . '/best', 0777);
        }

        if (!file_exists($dirDest . '/thumb')) {
            mkdir($dirDest . '/thumb', 0777);
        }

        if (!file_exists($dirDest . '/best')) {
            mkdir($dirDest . '/best', 0777);
        }

        return $dirDest;
    }

    public function bothFileIsExist($dir, $file) {
        if (file_exists($dir . '/' . $file)) {
            $file = explode('.', $file);
            $newName = $file[0] . '-' . date('ymd-His') . '.' . end($file);
            return $this->bothFileIsExist($dir, $newName);
        } else {
            return str_replace('//', '/', $dir . '/' . $file);
        }
    }

    public function saveFileAs($tmp, $dest) {
//        var_dump($this->getFileInDir($dest)) or die();
        $destThumb = $this->getFileDir($dest) . '/thumb/' . $this->getFileInDir($dest);
        $destBest = $this->getFileDir($dest) . '/best/' . $this->getFileInDir($dest);
//        var_dump($destThumb) or die();
        if ($this->isImage($dest) == TRUE) {
            $PhpThumbFactory = new PhpThumbFactory();
            $PhpThumbFactory->create($tmp)->Resize($this->sizeDefault['x'], $this->sizeDefault['y'])->save($dest);
            $PhpThumbFactory->create($tmp)->Resize($this->sizeThumb['x'], $this->sizeThumb['y'])->save($destThumb);
//            $PhpThumbFactory->create($tmp)->save($destBest);
            copy($tmp, $destBest);
        } else {
            move_uploaded_file($tmp, $dest);
        }
    }

    public function isImage($dest) {

        if (in_array($this->getFileExt($dest), $this->imageExt)) {
            return true;
        } else {
            return false;
        }
    }

    public function isFlash($dest) {

        if (in_array($this->getFileExt($dest), $this->flashExt)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFileDir($fileDir) {
        $fileDir = explode('/', $fileDir);
        array_pop($fileDir);
        return implode('/', $fileDir);
    }

    public function getFileInDir($fileDir) {
        $f = explode('/', $fileDir);
        return end($f);
    }

    public function getFileExt($fileDir) {
        $f = explode('.', $fileDir);
        return strtolower(end($f));
    }

    public function getImageThumb($dir) {
        $thumb = $this->getFileDir($dir) . '/thumb/' . $this->getFileInDir($dir);
        if (file_exists($thumb)) {
            return $thumb;
        } else {
            return $dir;
        }
    }

    public function getImageBest($dir) {
        $best = $this->getFileDir($dir) . '/best/' . $this->getFileInDir($dir);
        if (file_exists($best)) {
            return $best;
        } else {
            return $dir;
        }
    }

    public function delImageProd($dir) {
        $destThumb = $this->getFileDir($dir) . '/thumb/' . $this->getFileInDir($dir);
        $destBest = $this->getFileDir($dir) . '/best/' . $this->getFileInDir($dir);
        if (file_exists($dir))
            unlink($dir);
        if (file_exists($this->getImageThumb($dir)))
            unlink($this->getImageThumb($dir));
        if (file_exists($this->getImageBest($dir)))
            unlink($this->getImageBest($dir));
    }

    public function getImage($data, $baseUrl) {
        if ($this->isImage($data) == true) {
            return '<div align="center"><a href="' . $this->link . '"><img src="' . $baseUrl . $this->getImageQuality($data) . '" alt="' . $this->alt . '" width="'.$this->flashWidth.'" height="'.$this->flashHight.'"/></a></div>';
        } else {
            $object = '
                <script type="text/javascript">
                swfobject.embedSWF("' . $baseUrl . $data . '", "' . $this->id . '", "' . $this->flashWidth . '", "' . $this->flashHight . '", "9.0.0", "' . $baseUrl . 'documents/swf/swfobject/expressInstall.swf");
                </script>';
            $object .= '
                <div id="' . $this->id . '">
                Browser Not Support flash Player
                </div>';
            return $object;
        }
    }

    public function getImageQuality($dir) {
        if ($this->quality == 'best') {
            return $this->getImageBest($dir);
        } elseif ($this->quality == 'thumb') {
            return $this->getImageThumb($dir);
        } else {
            return $dir;
        }
    }

    public function getOld_big_brands($dir) {
        $file_exten = $this->getFileExt($dir);
        $big_res = str_replace('.' . $file_exten, '_big.' . $file_exten, $dir);
        if (file_exists($big_res)) {
            return $big_res;
        } else {
            return $this->getImageBest($dir);
        }
    }

}

?>
