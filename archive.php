<!-- cunstom code -->
<div class="row">
<div class="col-md-3 sidebarProducts">
<?php get_sidebar(); ?>
</div>
<div class="col-md-9">
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        
        <?php
        $cate = get_queried_object();
        $cateID = $cate->term_id;
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail_size' );
        ?>  <?php
        $args = array(
            'post_type' => "product",
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'terms' => $cateID,
                    'operator' => 'IN',
                )
            )
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
            
                    $query->the_post();
            
                    global $product;
            
                    $product = get_product( get_the_ID() ); 
            
                    ?>
            <div class="row">
            
                      <div class="col-md-4 ">
            
                            <div class="product-img">
            
                               <div class="product-thumb">
            
                                       <a href="<?php echo get_the_permalink(); ?>" class="product-detail">
            
                                           <?php echo get_the_post_thumbnail(); ?>
            
                                       </a>
            
                                   </div>
            
                                
            
                                <div class="product-price">
                                <h6><?php echo get_the_title(); ?></h6>
                                    <strong class="price">$<?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?></strong>
            
            
                        <div class="addToCart">
                        <?php
            
            $products_ids_array = array();
            foreach( WC()->cart->get_cart() as $cart_item ){
                $products_ids_array[] = $cart_item['product_id'];
            }
            if(in_array(get_the_ID(), $products_ids_array)) {
                echo '<a href="'.site_url().'/cart/">View Cart</a>';
            } else {
                echo '<a href="'.$product->add_to_cart_url().'">Add to Cart</a>';
            }
            ?>
                        </div>
                                    
            
            
        </div>
                                </div>
           
                            </div>
            
                     </div>
            
                    <?php
            
                }
            
            } else {
            
                // no posts found
            
            }
            
            
            
            // Restore original Post Data
            
            wp_reset_postdata();
        ?>
    </main><!-- .site-main -->
    <?php get_sidebar( 'content-bottom' ); ?>
</div><!-- .content-area -->
</div>
        </div>
</div>
<!-- custom code -->
