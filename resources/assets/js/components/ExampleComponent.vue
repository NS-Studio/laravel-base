<template>
  <b-row>

    <b-col>

      <b-card title="Example Card Component"
              img-src="https://picsum.photos/5000/3000/?image=41&blur"
              img-alt="Image"
              img-top
              style="width: 100%;"
              class="mb-2">
        <p class="card-text">
          This is just an example component to give you an intro how you'll components will be rendered.
        </p>
        <b-button href="/"
                  variant="primary">Go Home
        </b-button>
      </b-card>
    </b-col>

  </b-row>
</template>

<script>
    export default {

        name: 'example-component',
    }
</script>
