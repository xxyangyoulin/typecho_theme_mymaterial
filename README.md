## Typecho My Material 主题

魔改了一下Material主题，闲着也是闲着...  
基本实现了全局pjax加载..links插件支持..代码高亮插件pjax支持…背景音乐...如果你喜欢我非常高兴😄。

预览: [小酌一杯](https://yangyoulin.com)    [说明文档](https://yangyoulin.com/index.php/archives/20.html)  



## 更新日志
- 2019.06.14 解决-webkit-overflow-scrolling:touch导致ios上的index-z失效问题.
- 2019.03.27 radio报错的问题.
- 2019.03.06 主题在某些情况下报错的问题.
- 2019.02.11 归档分类加载更多的BUG.
- 2019.02.10 添加豆瓣书单。
- 2019.02.08 添加读者墙 修改已知问题.
- 2019.02.01 添加RSS聚合.
- 2019.01.27 添加背景音乐播放面板，全新的播放界面设计.


## 特性

1. 代码高亮使用的:CodeHighlighter  
  使用其他的需要在pjax:end回调中加入对应的代码高亮渲染函数.
2. 友链插件: Links  
  添加了一个Links友链样式
3. 目录生成: MenuTree(我的修改版)
4. 支持文章头图
5. 自定义首页界面
6. 背景音乐（网易云id或者直接填音乐URL）
7. 豆瓣图书（API暂时不可用了，豆瓣貌似关闭了API）
8. ...

![Typecho My Material](https://yangyoulin.com/usr/uploads/2019/02/4031308670.png)

## 用到的插件
- 留言墙：[Avatars](http://www.yzmb.me/archives/net/avatars-for-typecho)
- 代码高亮： [CodeHighlighter-for-Typecho](https://github.com/Copterfly/CodeHighlighter-for-Typecho "CodeHighlighter-for-Typecho")
- 文章索引： [MenuTree](https://github.com/mnnyang/MenuTree)
- 友链：[Links](http://www.imhan.com/archives/typecho_links_20141214)

直接打包下载（修改了部分插件）：[插件.zip](https://yangyoulin.com/usr/uploads/2019/03/2156462267.zip)



## 注意
1. 评论成功却没有显示: 尝试关闭评论的垃圾保护机制.
2. 下载解压之后，重命名为`typecho_theme_mymaterial`.


> Email: xxyangyoulin@gmail.com  
> Blog: yangyoulin.com