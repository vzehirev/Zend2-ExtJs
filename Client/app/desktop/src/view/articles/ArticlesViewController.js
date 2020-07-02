Ext.define('ModernApp.view.articles.ArticlesViewController', {
	extend: 'Ext.app.ViewController',
	alias: 'controller.articlesviewcontroller',
	store: 'articlesstore',

	onDelete(grid, info) {
		Ext.Msg.confirm('Delete article?', info.record.get('title'), function (answer) {
			if (answer === 'yes') {
				let store = this.getStore('articlesstore');
				store.remove(info.record);
				store.load();
			}
		}, this);
	},

	addArticle(sender, info) {
		let title = this.lookup('title').getValue();
		let content = this.lookup('content').getValue();

		let article = Ext.create('ModernApp.model.Article');
		article.set('title', title);
		article.set('content', content);

		let store = this.getStore('articlesstore');
		store.add(article);
		store.load();
	},
});
