<?php

/**
 * Created by PhpStorm.
 * User: xxyangyoulin
 * Date: 2019-02-07
 * Time: 16:32
 */
class DoubanBook
{

    static function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);
        if ($contents) {
            return $contents;
        } else {
            return FALSE;
        }
    }

    static public function getDoubanData($id = '155395812')
    {
        $url = "https://api.douban.com/v2/book/user/{$id}/collections?count=100";

        $cache_dir = './douban_cache/';
        $cache_img_dir = './douban_cache/img/';
        if (!file_exists($cache_dir)) {
            mkdir($cache_dir);
            mkdir($cache_img_dir);
        }

        $cache_file = $cache_dir . 'cache_' . md5($url);

        $timedif = @(time() - filemtime($cache_file));
        file_put_contents($cache_dir . 't', $timedif);
        if ($timedif < 3600 * 24 * 7) {/*一星期更新一次*/
            $json_content = unserialize(join('', file($cache_file)));
        } else {
            // cached file is too old, create new
            $json_content = json_decode(self::curl_get_file_contents($url), true);
            $serialized = serialize($json_content);
            if ($f = @fopen($cache_file, 'w')) {
                fwrite($f, $serialized, strlen($serialized));
                fclose($f);
            }
        }

        $readlist = $readinglist = [];
        $res = $json_content['collections'];
        foreach ($res as $v) {
            try {
                $book_name = $v['book']['title'];
                $book_author = implode(', ', $v['book']['author']);
                $book_url = $v['book']['alt'];
                $summary = $v['book']['summary'];

                $book_img = $v['book']['images']['medium'];
                $imgName = mb_split('/', $book_img)[count(mb_split('/', $book_img)) - 1];


                if (!file_exists($cache_img_dir . $imgName)) {
                    $imgData = self::curl_get_file_contents($book_img);
                    file_put_contents($cache_img_dir . $imgName, $imgData);
                }

                $book_img = trim($cache_img_dir, '.') . $imgName;
                $item = array("name" => $book_name, 'author' => $book_author,
                    "img" => $book_img, "url" => $book_url, 'summary' => $summary);

                if ($v['status'] == "read") {
                    $readlist[] = $item;
                } elseif ($v['status'] == "reading") {
                    $readinglist[] = $item;
                }
            } catch (Exception $e) {

            }
        }

        return [$readlist, $readinglist];
    }
}
