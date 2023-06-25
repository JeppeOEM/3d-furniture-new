<template>
    <div
        class="col-6 col-md-3 gx-0 pad"
        v-for="item in configurations.rows"
        :key="item.id"
    >
        <a
            :href="
                route('editor.unique', {
                    uniqueValue: removeFileExtension(item.identifier)
                })
            "
        >
            <img :src="getAllImgPath(item.url)" class="img-fluid" alt="Image" />
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            configurations: [],
            type: 'dusk',
            size: '2seater',
            rows: []
        }
    },
    mounted() {
        this.getRows('all')
    },
    methods: {
        removeFileExtension(name) {
            let lastIndex = name.lastIndexOf('.')
            name = name.substring(0, lastIndex)
            console.log(name)
            return name
        },

        getAllImgPath(url) {
            var startIndex = url.indexOf('/assets/') // Find the index of "/assets/"
            var modifiedUrl = url.substring(startIndex)
            const path = `${modifiedUrl}`
            return path
        },

        getRows(size) {
            axios
                .get(route('planner.show'), {
                    params: {
                        size,
                        type: this.type
                    }
                })
                .then((response) => {
                    this.configurations = response.data
                    console.log(this.configurations)
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>

<!-- getImgPath(filename, type, size) {
            var parts = filename.split("/"); // Split the URL by "/"
            var extractedName = parts.pop();
            const path = `/assets/configuration_thumbnails/${type}/${size}/${extractedName}`;
            return path;
        }, -->
