<script>
	export default {
		data: () => ({
			items: [
				{
					title: 'String',
					props: { value: null }
				},
				{
					title: 'Simple array',
					props: {
						type: 'array',
						value: ['String 1', 'String 2']
					}
				},
				{
					title: 'Array with strictly 3 items',
					props: {
						type: 'array',
						value: ['String 1', 'String 2', 'String 3'],
						length: 3
					}
				},
				{
					title: 'Array with 2-5 elements',
					props: {
						type: 'array',
						value: ['String 1', 'String 2', 'String 3'],
						min: 2,
						max: 5
					}
				},
				{
					title: 'Checkbox',
					props: {
						type: 'checkbox',
						value: false
					}
				},
				{
					title: 'Color',
					props: {
						type: 'color',
						value: 'aabb22'
					}
				},
				{
					title: 'Date',
					props: {
						type: 'date',
						value: 'now'
					}
				},
				{
					title: 'Datetime',
					props: {
						type: 'datetime',
						value: 'now'
					}
				},
				{
					title: 'Time',
					props: {
						type: 'time',
						value: '10:00'
					}
				},
				{
					title: 'Time interval',
					props: {
						type: 'time-interval',
						value: null
					}
				},
				{
					title: 'File',
					props: {
						type: 'file',
						value: null
					}
				},
				{
					title: 'Floating point',
					props: {
						type: 'float',
						value: Math.PI
					}
				},
				{
					title: 'Gallery',
					props: {
						type: 'gallery',
						value: null
					}
				},
				{
					title: 'Geo point',
					props: {
						type: 'geo-point',
						height: 300,
						value: null
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
					title: 'Key-value pairs',
					props: {
						type: 'meta',
						value: null
					}
				},
				{
					title: 'Number',
					props: {
						type: 'number',
						value: 10
					}
				},
				{
					title: 'Radio buttons',
					props: {
						type: 'radio-select',
						value: null,
						options: [
							{
								value: 1,
								title: 'Option 1'
							},
							{
								value: 2,
								title: 'Option 2'
							},
							{
								value: 3,
								title: 'Option 3'
							}
						]
					}
				},
				{
					title: 'Single relation',
					props: {
						type: 'relation',
						entity: 'posts',
						value: null
					}
				},
				{
					title: 'Single relation with inline creating',
					props: {
						type: 'relation',
						entity: 'tags',
						allowCreate: true,
						createDefaults: { sort: 1000 },
						value: null
					}
				},
				{
					title: 'Multiple relation',
					props: {
						type: 'relation',
						entity: 'posts',
						multiple: true,
						value: null
					}
				},
				{
					title: 'Select',
					props: {
						type: 'select',
						value: null,
						options: [
							{
								value: 1,
								title: 'Option 1'
							},
							{
								value: 2,
								title: 'Option 2'
							},
							{
								value: 3,
								title: 'Option 3'
							}
						]
					}
				},
				{
					title: 'Select multiple',
					props: {
						type: 'select',
						value: null,
						multiple: true,
						options: [
							{
								value: 1,
								title: 'Option 1'
							},
							{
								value: 2,
								title: 'Option 2'
							},
							{
								value: 3,
								title: 'Option 3'
							}
						]
					}
				},
				{
					title: 'Subform (inner object)',
					props: {
						type: 'subform',
						fields: {
							name: { type: 'string', placeholder: 'Name' },
							contacts: {
								type: 'array',
								title: 'Contacts',
								itemProps: {
									type: 'subform',
									fields: {
										key: { placeholder: 'Contact type' },
										value: { placeholder: 'Contact value' }
									}
								}
							}
						},
						value: null
					}
				},
				{
					title: 'Switcher',
					props: {
						type: 'switcher',
						value: null
					}
				},
				{
					title: 'Textarea',
					props: {
						type: 'textarea',
						value: null
					}
				},
				{
					title: 'WYSIWYG (CKEditor)',
					props: {
						type: 'wysiwyg',
						value: null
					}
				}
			]
		})
	};
</script>
<template lang="pug">
	page.page-fields
		span(slot="title") Field types demo
		.box: .box-body.table-responsive.no-padding
			table.table.table-bordered
				thead: tr
					th Description
					th Field
					th Component props
				tbody
					tr(v-for="item in items")
						th {{ item.title }}
							br
							a(:href="'https://mr-timofey.gitbooks.io/vue-admin/content/fields.html#' + (item.props.type || 'text')" target="_blank")
								i.fas.fa-external-link-alt
								!=' docs'
						td: field(v-bind="item.props" v-model="item.props.value")
						td: display(type="json" :value="item.props")
</template>
<style lang="stylus">
	.page-fields
		tbody th
			width 280px
</style>