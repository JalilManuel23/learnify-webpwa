<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> {{title}} </h6>
        </div>
        <div class="card-body">
            <p>
                {{body}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true
        },
        body: {
            type: String,
            required: true
        }
    },
    mounted() {
        console.log('Component Mounted')
    }
}
</script>