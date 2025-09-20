 const notices = [
            {
                id: 1,
                title: "Semester End Examinations Schedule",
                content: "The semester end examinations will commence from September 15, 2025. Students are advised to check the detailed timetable on the student portal. All examinations will be conducted in offline mode following COVID-19 protocols.",
                category: "Examinations",
                date: "2025-08-24"
            },
            {
                id: 2,
                title: "Library Extended Hours During Exams",
                content: "The college library will extend its working hours during the examination period. From September 1st to September 30th, the library will remain open from 8:00 AM to 10:00 PM on all working days.",
                category: "Academic Notices",
                date: "2025-08-24"
            },
            {
                id: 3,
                title: "Annual Cultural Festival Registration",
                content: "Registration for the annual cultural festival 'Vibrance 2025' is now open. Students can register for various events including dance, music, drama, and art competitions. Last date for registration is September 5, 2025.",
                category: "Events & Activities",
                date: "2025-08-25"
            },
            {
                id: 4,
                title: "Merit Scholarship Applications Open",
                content: "Applications for merit-based scholarships are now being accepted. Eligible students with CGPA above 8.5 can apply. Required documents include academic transcripts, income certificate, and recommendation letters. Deadline: August 30, 2025.",
                category: "General Announcements",
                date: "2025-08-25"
            },
            {
                id: 5,
                title: "Guest Lecture on Artificial Intelligence",
                content: "A guest lecture on 'Future of Artificial Intelligence in Healthcare' will be conducted by Dr. Sarah Johnson from MIT on September 10, 2025, at 2:00 PM in the main auditorium. All students are welcome to attend.",
                category: "Academic Notices",
                date: "2025-08-26"
            },
            {
                id: 6,
                title: "Sports Day 2025 Registration",
                content: "Annual Sports Day will be held on September 20, 2025. Students can register for various sports events including cricket, football, basketball, badminton, and athletics. Registration deadline is September 8, 2025.",
                category: "Events & Activities",
                date: "2025-08-26"
            }
        ];

        let filteredNotices = [...notices];
        let currentFilter = null;

        // Format date function
        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            return date.toLocaleDateString('en-GB', options);
        }

        // Display notices function
        function displayNotices(noticesToShow = filteredNotices) {
            const container = document.getElementById('noticesContainer');
            
            if (noticesToShow.length === 0) {
                container.innerHTML = '<div class="no-notices">No notices found matching your criteria.</div>';
                return;
            }

            container.innerHTML = noticesToShow.map(notice => `
                <div class="notice-item" onclick="showNoticeModal(${notice.id})">
                    <div class="notice-title">${notice.title}</div>
                    <div class="notice-date">${formatDate(notice.date)}</div>
                </div>
            `).join('');
        }

        // Show notice modal
        function showNoticeModal(noticeId) {
            const notice = notices.find(n => n.id === noticeId);
            if (!notice) return;

            document.getElementById('modalTitle').textContent = notice.title;
            document.getElementById('modalContent').textContent = notice.content;
            document.getElementById('modalDate').textContent = `Posted on: ${formatDate(notice.date)}`;
            document.getElementById('modalCategory').textContent = notice.category;
            document.getElementById('noticeModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        // Close modal
        function closeModal(event) {
            if (event && event.target !== event.currentTarget) return;
            document.getElementById('noticeModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Filter by category
        function filterByCategory(category, buttonElement) {
            // Remove active class from all buttons
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
            
            if (currentFilter === category) {
                // If same category clicked, show all
                currentFilter = null;
                filteredNotices = [...notices];
            } else {
                // Filter by category
                currentFilter = category;
                filteredNotices = notices.filter(notice => notice.category === category);
                buttonElement.classList.add('active');
            }
            
            displayNotices(filteredNotices);
        }

        // Search notices
        function searchNotices() {
            const searchTerm = document.getElementById('searchBox').value.toLowerCase().trim();
            
            if (searchTerm === '') {
                filteredNotices = currentFilter ? 
                    notices.filter(notice => notice.category === currentFilter) : 
                    [...notices];
            } else {
                const baseNotices = currentFilter ? 
                    notices.filter(notice => notice.category === currentFilter) : 
                    notices;
                    
                filteredNotices = baseNotices.filter(notice => 
                    notice.title.toLowerCase().includes(searchTerm) ||
                    notice.content.toLowerCase().includes(searchTerm)
                );
            }
            
            displayNotices(filteredNotices);
        }

        // Show all notices
        function showAllNotices() {
            currentFilter = null;
            filteredNotices = [...notices];
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById('searchBox').value = '';
            displayNotices(filteredNotices);
        }

        // Placeholder functions for navigation
        function showHelp() {
            alert('Help: This is a college notice board system. You can search for notices, filter by category, and click on any notice to view details.');
        }

        function showSignUp() {
            alert('Sign Up functionality would be implemented here.');
        }

        function showSignIn() {
            alert('Sign In functionality would be implemented here.');
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            displayNotices();
        });