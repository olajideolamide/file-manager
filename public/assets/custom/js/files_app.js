Vue.component('admin-menu', {
    data: function () {
        return {

        }
    }
})


Vue.component('info-pane', {
    data: function () {
        return {

        }
    }
})




Vue.component('small-icon', {
    props: ['text', 'id'],
    data: function () {
        return {

        }
    },
    template: `
    <svg viewBox="0 0 2048 2048" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd; width: 30px; height: 30px" xmlns="http://www.w3.org/2000/svg" class="me-3" v-bind:data-file-id="id">



  <g id="Layer_x0020_1" v-bind:data-file-id="id">
    <rect class="fil0" width="2048" height="2048" style="fill:none" v-bind:data-file-id="id"/>
    <rect class="fil0" x="255.999" y="255.999" width="1536" height="1536" style="fill:none" v-bind:data-file-id="id"/>
    <path class="fil1" d="M1303.19 263.999l328.759 329.158 -269.982 0c-32.328,0 -58.7764,-26.4484 -58.7764,-58.7764l0 -270.382z" style="fill:#78909C" v-bind:data-file-id="id"/>
    <path class="fil2" d="M454.851 263.999l848.395 0 0 268.747c0,33.228 27.1843,60.4111 60.4111,60.4111l268.344 0 0 814.843c0,22.0004 -17.9988,39.9992 -39.9992,39.9992l-1137.15 0c-22.0004,0 -39.9992,-17.9988 -39.9992,-39.9992l0 -1104c0,-22.0004 17.9988,-39.9992 39.9992,-39.9992z" style="fill:#CFD8DC" v-bind:data-file-id="id"/>
    <polygon class="fil3" points="671.999,763.342 1408,763.342 1408,827.344 671.999,827.344 " style="fill:#546E7A;fill-rule:nonzero" v-bind:data-file-id="id"/>
    <polygon class="fil3" points="671.999,987.337 1408,987.337 1408,1051.34 671.999,1051.34 " style="fill:#546E7A;fill-rule:nonzero" v-bind:data-file-id="id"/>
    <path class="fil4" d="M337.396 1226.19l1373.21 0c22.3748,0 42.7347,9.23387 57.5103,24.1075 14.7378,14.8358 23.8866,35.2382 23.8866,57.6189l0 394.353c0,22.3807 -9.15001,42.7819 -23.8866,57.6178 -14.7768,14.8736 -35.1366,24.1087 -57.5103,24.1087l-1373.21 0c-22.3725,0 -42.7347,-9.23505 -57.5115,-24.1087 -14.7366,-14.8335 -23.8855,-35.2347 -23.8855,-57.6178l0 -394.353c0,-22.3819 9.14883,-42.7831 23.8855,-57.6189 14.7744,-14.8736 35.1366,-24.1075 57.5115,-24.1075z" style="fill:#546E7A" v-bind:data-file-id="id"/>
    <text style="fill: rgb(255, 255, 255); font-family: Ubuntu; font-size: 88.5px; font-weight: 700; text-transform: uppercase; white-space: pre;" transform="matrix(5.499951, 0, 0, 4.635999, -4377.054199, -5193.73877)" x="48%" y="1476.54" text-anchor="middle" v-bind:data-file-id="id">{{text | truncate(4, '.')}}</text>
  </g>
</svg>
   `
})


Vue.component('small-folder', {
    props: ['id'],
    data: function () {
        return {

        }
    },
    template: `<svg viewBox="476.646 525.165 150.477 150" width="150.477px" height="150px" style="width: 30px; height: 30px" xmlns="http://www.w3.org/2000/svg" class="me-3" v-bind:data-file-id="id">

    <rect class="fil0" x="500.03" y="561.816" width="100" height="100.038" style="fill:none" v-bind:data-file-id="id"/>
    <rect x="477.123" y="525.165" width="150" height="150" style="fill: none;" v-bind:data-file-id="id"/>
    <g transform="matrix(0.304878, 0, 0, 0.305672, 473.597687, 521.723145)" v-bind:data-file-id="id">
      <g v-bind:data-file-id="id">
        <polygon fill="#FFE352" points="10,156 40,436 472,436 502,156" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <polygon fill="#FFB236" points="192,116 182,76 82,76 72,116 40,116 40,156 472,156 472,116" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <rect x="69" y="356" transform="matrix(-1 4.491373e-11 -4.491373e-11 -1 258 760)" fill="#FFB236" width="120" height="48" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <rect x="69" y="316" transform="matrix(-1 1.866717e-11 -1.866717e-11 -1 258 652)" fill="#6E83B7" width="120" height="20" v-bind:data-file-id="id"/>
      </g>
    </g>
  </svg>
   `
})





Vue.component('large-icon', {
    props: ['text', 'id'],
    data: function () {
        return {

        }
    },
    template: `
    <svg class="card-img-top" v-bind:data-file-id="id" viewBox="534.395 432.458 300 300"  xmlns="http://www.w3.org/2000/svg">

    <rect x="534.395" y="432.458"  style="fill: none;" v-bind:data-file-id="id"/>
    <g id="Layer_x0020_1" transform="matrix(0.073242, 0, 0, 0.073242, 611.619934, 509.683258)" v-bind:data-file-id="id">
      <rect class="fil0" width="2048" height="2048" style="fill:none" v-bind:data-file-id="id"/>
      <rect class="fil0" x="255.999" y="255.999" width="1536" height="1536" style="fill:none" v-bind:data-file-id="id"/>
      <path class="fil1" d="M1303.19 263.999l328.759 329.158 -269.982 0c-32.328,0 -58.7764,-26.4484 -58.7764,-58.7764l0 -270.382z" style="fill:#78909C" v-bind:data-file-id="id"/>
      <path class="fil2" d="M454.851 263.999l848.395 0 0 268.747c0,33.228 27.1843,60.4111 60.4111,60.4111l268.344 0 0 814.843c0,22.0004 -17.9988,39.9992 -39.9992,39.9992l-1137.15 0c-22.0004,0 -39.9992,-17.9988 -39.9992,-39.9992l0 -1104c0,-22.0004 17.9988,-39.9992 39.9992,-39.9992z" style="fill:#CFD8DC" v-bind:data-file-id="id"/>
      <polygon class="fil3" points="671.999,763.342 1408,763.342 1408,827.344 671.999,827.344 " style="fill:#546E7A;fill-rule:nonzero" v-bind:data-file-id="id"/>
      <polygon class="fil3" points="671.999,987.337 1408,987.337 1408,1051.34 671.999,1051.34 " style="fill:#546E7A;fill-rule:nonzero" v-bind:data-file-id="id"/>
      <path class="fil4" d="M337.396 1226.19l1373.21 0c22.3748,0 42.7347,9.23387 57.5103,24.1075 14.7378,14.8358 23.8866,35.2382 23.8866,57.6189l0 394.353c0,22.3807 -9.15001,42.7819 -23.8866,57.6178 -14.7768,14.8736 -35.1366,24.1087 -57.5103,24.1087l-1373.21 0c-22.3725,0 -42.7347,-9.23505 -57.5115,-24.1087 -14.7366,-14.8335 -23.8855,-35.2347 -23.8855,-57.6178l0 -394.353c0,-22.3819 9.14883,-42.7831 23.8855,-57.6189 14.7744,-14.8736 35.1366,-24.1075 57.5115,-24.1075z" style="fill:#546E7A" v-bind:data-file-id="id"/>
      <text x="340%" y="1656.951" style="fill: rgb(255, 255, 255); font-family: &quot;Arial Black&quot;; font-size: 398.2px; white-space: pre; text-transform: uppercase" text-anchor="middle" v-bind:data-file-id="id">{{text | truncate(4, '.')}}</text>
    </g>
  </svg>
   `
})


Vue.component('large-folder', {
    props: ['id'],
    data: function () {
        return {

        }
    },
    template: `<div class="w-100 h-100" v-bind:data-file-id="id">
    <svg viewBox="401.568 465.408 300 300" xmlns="http://www.w3.org/2000/svg" v-bind:data-file-id="id">

    <rect x="401.568" y="465.408" width="300" height="300" style="fill: rgb(255, 255, 255);" v-bind:data-file-id="id"/>
    <rect class="fil0" x="500.03" y="561.81" width="100" height="100" style="fill:none" v-bind:data-file-id="id"/>
    <g transform="matrix(0.304878, 0, 0, 0.305556, 473.597687, 521.732056)" v-bind:data-file-id="id">
      <g v-bind:data-file-id="id">
        <polygon fill="#FFE352" points="10,156 40,436 472,436 502,156" style="" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <polygon fill="#FFB236" points="192,116 182,76 82,76 72,116 40,116 40,156 472,156 472,116" style="" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <rect x="69" y="356" transform="matrix(-1 4.491373e-11 -4.491373e-11 -1 258 760)" fill="#FFB236" width="120" height="48" style="" v-bind:data-file-id="id"/>
      </g>
      <g v-bind:data-file-id="id">
        <rect x="69" y="316" transform="matrix(-1 1.866717e-11 -1.866717e-11 -1 258 652)" fill="#6E83B7" width="120" height="20" style="" v-bind:data-file-id="id"/>
      </g>
    </g>
  </svg>
  </div>
   `
})


var file_app = new Vue({
    el: '#file_app',
    data: {
        parent: "",
        search_term: "",
        sort_column: "",
        sort_dir: "",
        show_list: "true",
        folders: {},
        files: [],
        main_pane_active_class: 'col-lg-12',
        info_pane_active_class: '',
        info_pane_data: {
            title: "",

        },
        current_info_item: "",
        selected: [],
        all_selected: false,
        bulk_options_class: "disabled",
        breadcrumb: [],
        root_breadcrumb: {
            "id": "",
            "name": "All Files"
        },
        visible_breadcrumb: [],
        dropdown_breadcrumb: []

    },
    computed: {
        current_info_item_object: {
            get: function () {
                if (!this.current_info_item || !this.getItemFromFiles(this.current_info_item)) return {};
                return this.getItemFromFiles(this.current_info_item);
            }
        }


    },
    watch: {
        files: function () {
            refreshFolders();
        },
        breadcrumb: function () {
            let len = this.breadcrumb.length;
            this.dropdown_breadcrumb = [];
            this.visible_breadcrumb = this.breadcrumb;
            if (len > 5) {
                this.dropdown_breadcrumb = this.breadcrumb.slice(0, -4);
                this.visible_breadcrumb = this.breadcrumb.slice(-4);
            }


        },
        parent: function () {
            refetchPath();

        },
        search_term: function () {
            refetchData();
        },
        all_selected: function (val) {
            this.selected = [];
            if (val == true) {
                for (val of this.files) {
                    this.selected.push(val.id);
                }
            }
        },
        selected: function (val) {
            if (val.length > 0) this.bulk_options_class = "";
            else this.bulk_options_class = "disabled";
        }
    },
    methods: {
        getItemFromFiles(id) {
            return this.files.filter(obj => {
                return obj.id == id
            })[0]
        },
        removeItemFromFiles(id) {

            this.files = this.files.filter(item => item.id !== id);
        },
        truncateThis: function (str, n) {
            return (str.length > n) ? str.slice(0, n - 1) + "..." : str;
        },
        formatBytes(bytes, decimals = 1) {
            if (!+bytes) return '0 Bytes'

            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

            const i = Math.floor(Math.log(bytes) / Math.log(k))

            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        },
        showInfoPane() {
            this.main_pane_active_class = 'col-lg-9';
            this.info_pane_active_class = 'd-lg-block';
        },
        hideInfoPane() {
            this.main_pane_active_class = 'col-lg-12';
            this.info_pane_active_class = '';
        },
        clearAllSelected() {

            this.selected = [];
        },
        populateInfoPane(event) {
            this.clearAllSelected();
            this.all_selected = false;
            this.current_info_item = event.target.dataset.fileId;
            this.selected.push(event.target.dataset.fileId);
        }
    }
})