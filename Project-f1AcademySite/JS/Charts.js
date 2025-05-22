const ctxMostCommented = document.getElementById('mostCommentedChart').getContext('2d');
new Chart(ctxMostCommented, {
    type: 'bar',
    data: {
        labels: commentedTypes,
        datasets: [{
            label: 'Comment Count',
            data: commentCounts,
            backgroundColor: '#ff007a'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1200,
            easing: 'easeOutBounce'
        },
        plugins: {
            title: {
                display: true,
                text: 'Most Commented Story Types',
                color: 'white'
            }
        }
    }
});

const ctxStoryTypes = document.getElementById('storyTypesChart').getContext('2d');
new Chart(ctxStoryTypes, {
    type: 'pie',
    data: {
        labels: storyTypes,
        datasets: [{
            data: typeCounts,
            backgroundColor: ['#54c8e8', '#4b62ba', '#89389e', '#c8027c']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1000,
            easing: 'easeOutCirc'
        },
        plugins: {
            title: {
                display: true,
                text: 'Types of Stories Posted by Users',
                color: 'white'
            }
        }
    }
});

const ctxUserRoles = document.getElementById('userRolesChart').getContext('2d');
new Chart(ctxUserRoles, {
    type: 'doughnut',
    data: {
        labels: userRoles,
        datasets: [{
            data: userCounts,
            backgroundColor: ['#ff007a', '#54c8e8']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1000,
            easing: 'easeInOutQuart'
        },
        plugins: {
            title: {
                display: true,
                text: 'Distribution of User Roles',
                color: 'white'
            }
        }
    }
});