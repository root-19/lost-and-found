<?php
include_once __DIR__ . '/../../Models/UserModel.php';
use App\Models\UserModel;

$userModel = new UserModel();
$students = $userModel->getAllStudents();

include "../layout/administrator.php"; 
?>


    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Student List</h2>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($students): ?>
                    <?php foreach ($students as $student): ?>
                        <tr class="text-center">
                            <td class="border px-4 py-2"><?= htmlspecialchars($student['id']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($student['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-2">No students found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
