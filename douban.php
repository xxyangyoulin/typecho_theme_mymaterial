<?php
/**
 * Created by PhpStorm.
 * User: xxyangyoulin
 * Date: 2019-02-12
 * Time: 02:08
 */

 include $this->getThemeDir() . 'lib/DoubanBook.php';
                        $douBan = DoubanBook::getDoubanData();
                        if ($douBan[1]):?>
                            <blockquote style=";background-color: #EDF4ED;padding: 1px 8px;border-color: #2B9337">
                                <h1 style="padding: 0;color: #2B9337;line-height: 48px;margin: 0">在读的书</h1>
                            </blockquote>
                            <ul>
                                <?php foreach ($douBan[1] as $item): ?>
                                    <li><a target="_blank" href="<?php echo $item['url'] ?>"><img
                                                src="<?php echo $item['img'] ?>">
                                            <div class="info-wrap">
                                                <span>《<?php echo $item['name'] ?>》</span><span><?php echo $item['author'] ?></span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($douBan[2]): ?>
    <blockquote style=";background-color: #EDF4ED;padding: 1px 8px;border-color: #2B9337">
        <h1 style="padding: 0;color: #2B9337;line-height: 48px;margin: 0">想读的书</h1>
    </blockquote>
    <ul>
        <?php foreach ($douBan[2] as $item): ?>
            <li>
                <a target="_blank" href="<?php echo $item['url'] ?>"><img
                        src="<?php echo $item['img'] ?>">
                    <div class="info-wrap">
                        <span>《<?php echo $item['name'] ?>》</span><span><?php echo $item['author'] ?></span>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

                        <?php if ($douBan[0]): ?>
    <blockquote style=";background-color: #EDF4ED;padding: 1px 8px;border-color: #2B9337">
        <h1 style="padding: 0;color: #2B9337;line-height: 48px;margin: 0">读过的书</h1>
    </blockquote>
    <ul>
        <?php foreach ($douBan[0] as $item): ?>
            <li>
                <a target="_blank" href="<?php echo $item['url'] ?>"><img
                        src="<?php echo $item['img'] ?>">
                    <div class="info-wrap">
                        <span>《<?php echo $item['name'] ?>》</span><span><?php echo $item['author'] ?></span>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>