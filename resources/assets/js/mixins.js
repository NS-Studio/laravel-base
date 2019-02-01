function getTitle(vm) {
    const {title} = vm.$options;
    if (title) {
        return typeof title === 'function'
            ? title.call(vm)
            : title;
    }
}

export default {
    created() {
        const title = getTitle(this);
        if (title) {
            document.title = title;
        }
    },
    data() {

        return {

            isMobile: window.innerWidth < 768
        };
    },
    methods: {

        trans: function (item, params) {
            params = params || {};

            return lang.get(item, params);
        },

        money: function (value) {
            return money(value);
        },

        substr_end: function (value, length) {
            return substr_end(value, length);
        }
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 768;
            });
        });
    },
};