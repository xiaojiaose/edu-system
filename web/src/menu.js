export const ALL_MENUS = [
    {
        name: '学生',
        roles: ['student'],
        icon: 'el-icon-user-solid',
        children: [
            {name: '个人名片', path: '/students/info'},
            {name: '导师们', path: '/students/teaching'},
            {name: '关注老师们', path: '/students/following'},
        ],
    },

    {
        name: '老师',
        roles: ['teacher', 'system_admin'],
        icon: 'el-icon-s-custom',
        children: [
            {name: '创建学校', path: '/schools/create'},
            {name: '学校列表', path: '/schools/list'},
            {name: '我的学生', path: '/teachers/teaching'},
            {name: '我的粉丝', path: '/teachers/following'},
        ],
    },

    {
        name: '学校管理员',
        roles: ['teacher', 'school_admin', 'system_admin'],
        icon: 'el-icon-school',
        children: [
            {name: '学校列表', path: '/schools/list'},
        ],
    },

    {
        name: '系统管理员',
        roles: ['system_admin'],
        icon: 'el-icon-cpu',
        children: [
            {name: '审批学校申请', path: '/schools/list'}
        ],
    },
]
