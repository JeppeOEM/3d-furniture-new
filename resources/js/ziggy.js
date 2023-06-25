const Ziggy = {
    url: 'http://localhost',
    port: null,
    defaults: {},
    routes: {
        'sanctum.csrf-cookie': {
            uri: 'sanctum/csrf-cookie',
            methods: ['GET', 'HEAD']
        },
        'ignition.healthCheck': {
            uri: '_ignition/health-check',
            methods: ['GET', 'HEAD']
        },
        'ignition.executeSolution': {
            uri: '_ignition/execute-solution',
            methods: ['POST']
        },
        'ignition.updateConfig': {
            uri: '_ignition/update-config',
            methods: ['POST']
        },
        'configuration.configurationsByUser': {
            uri: 'configurations',
            methods: ['GET', 'HEAD']
        },
        'editor.store': { uri: 'editor', methods: ['POST'] },
        home: { uri: '/', methods: ['GET', 'HEAD'] },
        'configuration.store': { uri: 'configuration', methods: ['POST'] },
        'configuration.show': {
            uri: 'configuration',
            methods: ['GET', 'HEAD']
        },
        login: { uri: 'login', methods: ['GET', 'HEAD'] },
        'login.store': { uri: 'login', methods: ['POST'] },
        logout: { uri: 'logout', methods: ['DELETE'] },
        'user-account.create': {
            uri: 'user-account/create',
            methods: ['GET', 'HEAD']
        },
        'user-account.store': { uri: 'user-account', methods: ['POST'] }
    }
}

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes)
}

export { Ziggy }
