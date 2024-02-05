<?= $this->extend('layout/auth') ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url() ?>" class="h1">
                <b>
                    <img src="<?= base_url(\App\Constants\ApplicationConstant::ICON) ?>"
                         alt="<?= \App\Constants\ApplicationConstant::NAME ?>">
                </b>
                <?= \App\Constants\ApplicationConstant::SHORT_NAME ?>
            </a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Login to start your session</p>
            <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
            <?php endif ?>

            <?= form_open(url_to('login')) ?>
            <!-- Email -->
            <div class="input-group mb-3">
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= old('email') ?>" inputmode="email"
                       autocomplete="email" placeholder="<?= lang('Auth.email') ?>" required>
                <div class="input-group-append">
                    <label for="email" class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </label>
                </div>
            </div>


            <!-- Password -->
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" name="password"
                       inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>"
                       required>
                <div class="input-group-append">
                    <label for="password" class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </label>
                </div>
            </div>

            <div class="row">

                <!-- Remember me -->
                <div class="col-8">
                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember"
                                   id="remember" <?= old('remember') ? 'checked' : null ?> >
                            <label for="remember">
                                <?= lang('Auth.rememberMe') ?>
                            </label>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.col -->

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close() ?>

            <!--            --><?php //= $this->include('App\Modules\Shield\Views\components\social-auth-links') ?>

            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a
                            href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
            <?php endif ?>

            <?php if (setting('Auth.allowRegistration')) : ?>
                <p class="text-center"><?= lang('Auth.needAccount') ?> <a
                            href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
            <?php endif ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<?= $this->endSection() ?>
