<template>
  <div>
    <div class="d-flex">
      <form class="form form-horizontal container" @submit.prevent="logIn()">
        <div class="card">
          <div class="card-block row pb-0">
            <div class="card-text header">
              <div class="title mb-3">
                <h1>{{ $t('pages.signin.logInWithYourPsAccount') }}</h1>
              </div>
            </div>
          </div>
          <div class="card-block row pb-0">
            <div class="card-text">
              <div class="form-group row">
                <label class="form-control-label">{{ $t('pages.signin.email') }}</label>
                <div class="col-6">
                  <div class="form-group mb-0" :class="{ 'has-warning' : email.hasError }">
                    <input v-model="email.value" type="text" class="form-control" :class="{ 'is-warning' : email.hasError }">
                    <div v-if="email.hasError" class="warning-feedback">{{ email.errorMessage }}</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="form-control-label">{{ $t('pages.signin.password') }}</label>
                <div class="col-6">
                  <div class="form-group mb-0" :class="{ 'has-warning' : password.hasError }">
                    <input v-model="password.value" type="password" class="form-control" :class="{ 'is-warning' : password.hasError }">
                    <div v-if="password.hasError" class="warning-feedback">{{ password.errorMessage }}</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="form-control-label">&nbsp;</label>
                <div class="col-6">
                  <a href="#" @click.prevent="goToResetPassword()">{{ $t('pages.signin.forgotPassword') }}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex">
            <div class="container-fluid pl-0">
              <PSButton @click="previous()">{{ $t('pages.signin.back') }}</PSButton>
            </div>
            <div class="d-flex">
              <PSButton class="mr-3" ghost @click="goToSignUp()">{{ $t('pages.signin.signup') }}</PSButton>
              <PSButton primary type="submit">{{ $t('pages.signin.login') }}</PSButton>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="container">
        <Reassurance />
      </div>
    </div>
  </div>
</template>

<script>
  import PSButton from '@/components/form/button';
  import * as error from '@/lib/auth';
  import Reassurance from '@/components/block/reassurance';

  export default {
    name: 'Signin',
    components: {
      PSButton,
      Reassurance,
    },
    data() {
      return {
        email: {
          value: '',
          hasError: false,
          errorMessage: '',
        },
        password: {
          value: '',
          hasError: false,
          errorMessage: '',
        },
      };
    },
    methods: {
      logIn() {
        this.$store.dispatch({
          type: 'signIn',
          email: this.email.value,
          password: this.password.value,
        }).then(() => {
          this.$router.push('/authentication');
        }).catch((err) => {
          this.handleResponseError(err.error.message);
        });
      },
      goToSignUp() {
        this.$router.push('/authentication/signup');
      },
      goToResetPassword() {
        this.$router.push('/authentication/reset');
      },
      handleResponseError(err) {
        switch (err) {
        case error.EMAIL_NOT_FOUND:
          this.setEmailError(true, this.$t('firebase.error.emailNotFound'));
          this.resetPasswordError();
          break;
        case error.INVALID_EMAIL:
          this.setEmailError(true, this.$t('firebase.error.invalidEmail'));
          this.resetPasswordError();
          break;
        case error.INVALID_PASSWORD:
          this.setPasswordError(true, this.$t('firebase.error.invalidPassword'));
          this.resetEmailError();
          break;
        case error.MISSING_PASSWORD:
          this.setPasswordError(true, this.$t('firebase.error.missingPassword'));
          this.resetEmailError();
          break;
        default:
          this.setPasswordError(true, this.$t('firebase.error.defaultError'));
          this.setEmailError(true, this.$t('firebase.error.defaultError'));
          break;
        }
      },
      setPasswordError(hasError, message) {
        this.password.hasError = hasError;
        this.password.errorMessage = message;
      },
      setEmailError(hasError, message) {
        this.email.hasError = hasError;
        this.email.errorMessage = message;
      },
      resetEmailError() {
        this.email.hasError = false;
        this.email.errorMessage = '';
      },
      resetPasswordError() {
        this.password.hasError = false;
        this.password.errorMessage = '';
      },
      previous() {
        this.$router.push('/authentication');
      },
    },
  };
</script>

<style scoped>
  .card-text.header {
    text-align: center;
  }
  .card-text .title {
    font-size: 32px;
  }
  .card-text .text {
    font-size: 16px;
  }
  .card-text .step {
    font-size: 16px;
    font-weight: 600;
  }
  .d-flex {
    align-items: flex-start;
  }
  .max-size {
    max-width: 480px !important;
  }
</style>
