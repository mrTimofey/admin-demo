import base from 'vue-admin-front/src/components/shared/login-form.vue';

// noinspection JSUnusedGlobalSymbols
export default {
	extends: base,
	created() {
		this.data.form.login = 'admin@admin.com';
		this.data.form.password = 'secret';
	}
}