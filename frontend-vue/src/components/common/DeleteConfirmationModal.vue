<!-- DeleteConfirmationModal.vue -->
<template>
    <div>
      <div class="modal fade" :id="modalId" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" @click="confirmDeletion" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      modalId: {
        type: String,
        required: true,
      },
      deleteFunction: {
        type: Function,
        required: true,
      },
    },
    methods: {
      confirmDeletion() {
        this.deleteFunction();
        $(`#${this.modalId}`).modal('hide');
      },
    },
  };
  </script>
  