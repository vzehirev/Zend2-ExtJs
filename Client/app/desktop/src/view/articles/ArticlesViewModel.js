Ext.define('ModernApp.view.articles.ArticlesViewModel', {
	extend: 'Ext.app.ViewModel',
	alias: 'viewmodel.articlesviewmodel',
	stores: {
		articlesstore: {
			type: 'articles'
		}
	}
});
