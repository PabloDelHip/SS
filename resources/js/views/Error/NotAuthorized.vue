<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>403 Not Authorized</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item active">403 Not Authorized</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! You don't have permission.</h3>
          <p>
            We could not give you access on the page you were looking for.
            Meanwhile, you may 
            <router-link :to="{ path: '/' }">
              return to home.
            </router-link>
          </p>
        </div>
      </div>
    </section>
  </div>
</template>