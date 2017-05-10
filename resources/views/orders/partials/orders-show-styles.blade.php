<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black !important;
        background-color: #d9edf7;
    }

    .delete-assignment, .add-worker, .add-worker-form, .fa-chevron-circle-up {
        display: none;
    }

    .add-worker-form {
    {{$errors->has('addworkers') ?'display:block':''}}

    }

    .new-assignment {
    {{$errors->has('addworkers') ?'display:none':''}}

    }

    .assigner {
        margin-top: 1em;
    }

</style>