<script>
	import http from 'src/http';
	export default {
		data: () => ({
			items: [
				{
					title: 'Array',
					props: {
						type: 'array',
						value: [
							'String', false, 100
						]
					}
				},
				{
					title: 'Array with custom item type (boolean)',
					props: {
						type: 'array',
						value: [
							true, false, null
						],
						itemProps: {
							type: 'bool'
						}
					}
				},
				{
					title: 'Bool, boolean, checkbox',
					props: {
						type: 'checkbox',
						value: true
					}
				},
				{
					title: 'Color',
					props: {
						type: 'color',
						value: 'aaa'
					}
				},
				{
					title: 'Date',
					props: {
						type: 'date',
						value: '2018-01-28 12:00:00'
					}
				},
				{
					title: 'Date and time',
					props: {
						type: 'datetime',
						value: Date.now()
					}
				},
				{
					title: 'Time',
					props: {
						type: 'time',
						value: parseInt(Date.now() / 1000)
					}
				},
				{
					title: 'File',
					props: {
						type: 'file',
						value: '/sample-file.txt'
					}
				},
				{
					title: 'Float',
					props: {
						type: 'float',
						value: Math.PI,
						precision: 1
					}
				},
				{
					title: 'Gallery (images array)',
					props: {
						type: 'gallery',
						value: null
					}
				},
				{
					title: 'JSON',
					props: {
						type: 'json',
						value: {
							a: 'b',
							b: 200,
							c: 100.23,
							d: new Date()
						}
					}
				},
				{
					title: 'Raw HTML',
					props: {
						type: 'html',
						value: '<h3>Title</h3><p>Paragraph</p>'
					}
				},
				{
					title: 'Image',
					props: {
						type: 'image',
						value: null
					}
				},
				{
					title: 'Key-value pairs (JavaScript object)',
					props: {
						type: 'key-value',
						value: {
							title: 'Title',
							description: 'Description',
							keywords: 'Keywords'
						}
					}
				},
				{
					title: 'Relation (single, custom display)',
					props: {
						type: 'relation',
						entity: 'posts',
						display: 'Post "{{ name }}", ID = {{ id }}',
						value: {
							id: 1,
							name: 'Post title'
						}
					}
				},
				{
					title: 'Relation (multiple, Bootstrap btn-primary)',
					props: {
						type: 'relation',
						entity: 'posts',
						color: 'primary',
						value: [
							{
								id: 1,
								name: 'Post 1 title'
							},
							{
								id: 2,
								name: 'Post 2 title'
							},
							{
								id: 3,
								name: 'Post 3 title'
							}
						]
					}
				},
				{
					title: 'Relation (no link)',
					props: {
						type: 'relation',
						entity: 'posts',
						noLink: true,
						color: 'warning',
						value: {
							id: 1,
							name: 'Post title'
						}
					}
				}
			]
		}),
		mounted() {
			const boolField = this.items.find(item => item.props.type === 'checkbox'),
				colorField = this.items.find(item => item.props.type === 'color'),
				floatField = this.items.find(item => item.props.type === 'float'),
				imageField = this.items.find(item => item.props.type === 'image'),
				galleryField = this.items.find(item => item.props.type === 'gallery');
			this.changeValueInterval = setInterval(() => {
				if (boolField.props.value === true) boolField.props.value = false;
				else if (boolField.props.value === false) boolField.props.value = null;
				else boolField.props.value = true;
				colorField.props.value = Math.floor(Math.random() * 16777215).toString(16);
				floatField.props.precision = floatField.props.precision < 10 ? floatField.props.precision + 1 : 1
			}, 500);
			http.get('demo/images').then(res => {
				galleryField.props.value = res.data;
				imageField.props.value = res.data[0];
			});
		},
		beforeDestroy() {
			clearInterval(this.changeValueInterval);
		}
	};
</script>
<template lang="pug">
	page.page-displays
		span(slot="title") Display types demo
		.box: .box-body.table-responsive.no-padding
			table.table.table-bordered
				thead: tr
					th Field type
					th Display
					th Component props
				tbody
					tr(v-for="item in items")
						th {{ item.title }}
							br
							a(:href="'https://mr-timofey.gitbooks.io/vue-admin/content/displays.html#' + (item.props.type || 'text')" target="_blank")
								i.fas.fa-external-link-alt
								!=' docs'
						td: display(v-bind="item.props")
						td: display(type="json" :value="item.props")
</template>
<style lang="stylus">
	.page-displays
		tbody th
			width 280px
</style>