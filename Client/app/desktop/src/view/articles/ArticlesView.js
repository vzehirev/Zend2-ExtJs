Ext.define('ModernApp.view.articles.ArticlesView', {
	extend: 'Ext.grid.Grid',
	xtype: 'articlesview',
	title: 'Articles',
	viewModel: 'articlesviewmodel',
	controller: 'articlesviewcontroller',
	plugins: {
		rowedit: {
			selectOnEdit: true,
			autoConfirm: false,
		},
	},
	listeners: {
		edit: function () { this.getStore().load() }
	},
	selectable: {
		rows: false,
		cells: true
	},
	bind: {
		store: '{articlesstore}',
	},
	columns: [
		{ text: 'Id', dataIndex: 'id' },
		{ text: 'Title', dataIndex: 'title', flex: 1, editable: true, },
		{ text: 'Content', dataIndex: 'content', flex: 1, editable: true, },
		{
			text: 'Delete',
			cell: {
				tools: {
					delete: {
						iconCls: 'x-fa fa-trash',
						handler: 'onDelete',
						weight: 1,
					}
				}
			}
		}
	],
	items: [
		{
			xtype: 'toolbar',
			docked: 'top',
			items: [
				{
					xtype: 'textfield',
					label: 'Title',
					reference: 'title',
				},
				'->',
				{
					xtype: 'textfield',
					label: 'Content',
					reference: 'content',
				},
				'->',
				{
					xtype: 'button',
					text: 'Add article',
					handler: 'addArticle',
				}
			]
		}
	]
});
