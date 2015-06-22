
<div class="tab-pane active" id="home">
                <a href=""><img src="/papyrus/img/DSC05821.JPG" alt="Image" style="max-width: 780px; height: auto;"></a>
</div>
            
        <div>
            <h3>最新の記事</h3>
            <?php 
                foreach ($latest5post as $post){

                //echo $this->Html->image('recipes.html', array('alt'=>'Image','url' => '/papyrus/images/sandwich.jpg')) ;

                echo $this->Html->image($post['Picture']['name'], array('alt'=>'Image','url' => array('controller' => 'posts', 'action' => 'latest5post', 6))) ; 

                //echo $this->Html->link('画像を表示する', array('controller' => 'picture', 'action' => 'view', 1, '?' => array('height' => 75, 'width' => 75)));
                
                echo $this->Html->link($post['posts']['title'] , array('controller' => 'posts', 'action' => 'view', $post['posts']['id']));    

                //echo $this->Html->link('This is just a place holder, so you can see what the site would look like.' , array( 'url' => 'hblog.html', $post['Post']['id'])); 
                
            
                echo '<span class="date">';
                 
                    $posted_date = substr($post['posts']['created'],0,4).'年'.substr($post['posts']['created'],5,2).'月'.substr($post['posts']['created'],8,2).'日';     // 日付データを「　年　月　日」の形式に書き換える。
                    echo $posted_date.'by'.$post['User']['name'];     // 投稿日時と筆者名を表示する。
                
                echo '</span>';

            } // ここまでがforeach文の範囲

            ?>  
        </div>




<div>
            <div class="media">
                <div class="media-left media-middle" style="height: 64px; width: 64px;">
                <a href="/papyrus/img/bikecebumorning.jpg">
                    <!-- <img class="media-object" src="/papyrus/img/bikecebumorning.jpg" alt="投稿画像"> -->
                </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Media heading</h4>
                        フィリピン・セブ島ではバイクが移動手段として重要な地位をしめている。</br>
                        単独ライドだけでなく、２人、ときには３人（またはそれ以上！）と人を運ぶ手段としてもバイクは重宝されている。</br>
                        そんなセブ島では、バイクを持つフィリピーノにとって彼女または嫁さんの送迎は日課。</br>
                        セブ島　バイク通勤   </br>
                        若者も、おじさんも、女性を後ろに載せてバイクに乗る姿は、セブ島の日常風景となっている。</br>
                        写真は朝の通勤風景。</br>
                        信号待ちをしていると、このようなカップルが１０数台と横に並ぶこともしばしば。</br>
                        うらやましい・・・いや、ほほえましい風景だ。</br>
                        夜は夜で、ガイサノモールやSMモールの就業間際には、モール店員の彼女を待つバイク姿がモール前に多数。</br>
                        ちなみにセブ島のモール店員の制服はタイトでミニスカートなので女性はバイクにまたがらず、いわゆる横乗りで座っている。</br>
                        なのに平然と猛スピードで走っていたりするのはさすが。</br>
                        筆者も早くフィリピーナの彼女を作って、バイクの後ろに載せてみたいと思うこのごろだ・・・</br>
                </div>
            </div>




            <div class="tab-content body" style="margin-top: 85px;">
              <div class="tab-pane active" id="home">
                <a href="index.html"><img src="images/background.jpg" alt="Image" style="max-width: 780px; height: auto;"></a>
              </div>

                <ul>
                    <li class="current ">
                        <a href="blog.html"><img src="images/holi-turkey.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">グルメ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="images/fruits-and-bread.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">アクティビティ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="images/dessert.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">ローカル</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                </ul>


            </div>

            <div class="footer ">
                <ul>
                    <li>
                        <h2><a href="featured.html">グルメ</a></h2>
                        <a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="recipes.html">アクティビティ</a></h2>
                        <a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2><a href="videos.html">ローカル</a></h2>
                        <a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="blog.html">生活・留学</a></h2>
                        <a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
                    </li>
                </ul>
            </div>

            <div class="footer ">
                <ul>
                    <li>
                        <h2><a href="featured.html">Featured Recipes</a></h2>
                        <a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="recipes.html">A to Z Recipes</a></h2>
                        <a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2><a href="videos.html">Videos</a></h2>
                        <a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="blog.html">Blog</a></h2>
                        <a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
                    </li>
                </ul>
            </div>


</div>







<!-- File: /app/View/Post/index.ctp  (編集リンクを追加済み) -->
<h1>Home</h1>
<p>
    <?php  
    echo $this->Html->link("記事を書く", array('action' => 'add'));   // 、指定されたタイトル（最初のパラメータ）とURL(二つ目のパラメータ)でHTMLリンクを生成する。
    echo $this->Html->link("お気に入り", array('action' => 'favorite'));
    ?>
</p> 

<?php 
    echo $this->Form->create('Post', array('action' => 'result', 'type' => 'post'));
    echo $this->Form->input('search_word');
    echo $this->Form->end('検索');
?>


<div class="container">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>タイトル</th>
            <th>カテゴリー</th>
            <th>本文</th>
            <th>公開日</th>
        </tr>
    </thead>

<!-- $post配列をループして、投稿記事の情報を表示 -->

    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo 'No'.$post['Post']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id'])); ?>
            </td>
            <?php //debug($post); ?>
            <td><?php echo $this->Html->Link($post['Category']['name'], array('controller' => 'posts', 'action' => 'category_index', $post['Post']['category_id'])); ?></td>   
            <!--  ['controller' => 'posts']の部分は、この場合は省略が可能。 また、URLを作る情報がつまっている配列。  -->
    	<td>
                <?php echo $this->Form->postLink(
                    'Delete', 
                    array('controller' => 'posts','action' => 'delete', $post['Post']['id']), 
                    array('confirm' => 'Are you sure?'));
                    //var_dump($post['Post']['id']);
                ?>
                <?php echo $this->Html->link('Edit', array('controller' => 'posts','action' => 'edit', $post['Post']['id'])); ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>
