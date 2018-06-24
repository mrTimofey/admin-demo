<script>
	import base from 'vue-admin-front/src/components/shared/login-form.vue';

	// noinspection JSUnusedGlobalSymbols
	export default {
		extends: base,
		created() {
			this.form.login = 'admin@admin.com';
			this.form.password = 'secret';
		}
	};
</script>