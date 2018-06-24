<template lang="pug">
	page.page-displays
		span(slot="title") Administrative interface demo
		.lead
			p Demo site for <a href="https://github.com/mrTimofey/vue-admin" target="_blank">vue-admin-front</a> and <a href="https://github.com/mrTimofey/laravel-admin-api" target="_blank">mr-timofey/laravel-admin-api</a>.
			p Use aside links to learn more.
			br
			a.btn.btn-primary(href="https://github.com/mrTimofey/admin-demo" target="_blank") Demo source code
			!=' '
			a.btn.btn-primary(href="https://mr-timofey.gitbooks.io/vue-admin/" target="_blank") vue-admin-front docs
			!=' '
			a.btn.btn-primary(href="https://github.com/mrTimofey/laravel-admin-api" target="_blank") laravel-admin-api docs
</template>
<style lang="stylus">
	.page-displays
		tbody th
			width 280px
</style>