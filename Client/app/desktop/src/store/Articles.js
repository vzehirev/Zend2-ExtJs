Ext.define('ModernApp.store.Articles', {
    extend: 'Ext.data.Store',
    alias: 'store.articles',
    model: 'ModernApp.model.Article',
    autoLoad: true,
    autoSync: true,
    proxy: {
        type: 'jsonp',
        url: 'http://localhost/get-all-articles',
        api: {
            create: 'http://localhost/add-article',
            update: 'http://localhost/update-article',
            destroy: 'http://localhost/delete-article'
        },
    },
});
