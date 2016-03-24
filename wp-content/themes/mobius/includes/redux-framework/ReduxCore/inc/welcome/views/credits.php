<div class="wrap about-wrap">
    <h1><?php _e( 'Redux Framework - A Community Effort', 'redux-framework' ); ?></h1>

    <div
        class="about-text"><?php _e( 'We recognize we are nothing without our community. We would like to thank all of those who help Redux to be what it is. Thank you for your involvement.', 'redux-framework' ); ?></div>
    <div
        class="redux-badge"><i
            class="el el-redux"></i><span><?php printf( __( 'Version %s', 'redux-framework' ), ReduxFramework::$_version ); ?></span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

    <?php echo $this->contributors(); ?>
</div>