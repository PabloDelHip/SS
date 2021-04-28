<template>
    <div>

      <modal name="my-first-modal"
          :width="'60%'"
          :height="'auto'"
          :scrollable="true">
          <div class="modal-body row">
              <p> {{ textDescription }} </p>
          </div>
      </modal>
    </div>
</template>

<script>

  export default {
    props: ['textDescription'],
    methods: {
        async openModal() {
            this.$modal.show('my-first-modal')
        }
    }
  }
</script>
