<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classe;
use App\Entity\User;
use App\Entity\Place;
use App\Entity\Event;
use App\Entity\Student;

class DashboardController extends AbstractDashboardController
{
    private $userRepository;
    private $eventRepository;

    public function __construct(UserRepository $userRepository, EventRepository $eventRepository)
    {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Retrieve total number of users and events
        $nbUsers = $this->userRepository->count([]);
        $nbTotalEvents = $this->eventRepository->count([]);
        $nbPublicEvents = $this->eventRepository->count(['private' => false]); // Count public events
        $nbPrivateEvents = $this->eventRepository->count(['private' => true]); // Count private events
    
        // Retrieve the number of registered users per month
        $usersByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $startDate = (new \DateTime())->setDate((new \DateTime())->format('Y'), $i, 1);
            $endDate = (new \DateTime())->setDate((new \DateTime())->format('Y'), $i + 1, 1);
            
            $usersByMonth[$i] = $this->userRepository->createQueryBuilder('u')
                ->select('COUNT(u.id)')
                ->where('u.registrationDate >= :start')
                ->andWhere('u.registrationDate < :end')
                ->setParameter('start', $startDate)
                ->setParameter('end', $endDate)
                ->getQuery()
                ->getSingleScalarResult();
        }
        // Render the template and pass the statistics to the view
        return $this->render('admin/dashboard.html.twig', [
            'nbUsers' => $nbUsers,
            'nbTotalEvents' => $nbTotalEvents,
            'nbPublicEvents' => $nbPublicEvents,
            'nbPrivateEvents' => $nbPrivateEvents,
            'nbUsersJan' => $usersByMonth[1] ?? 0,
            'nbUsersFeb' => $usersByMonth[2] ?? 0,
            'nbUsersMar' => $usersByMonth[3] ?? 0,
            'nbUsersApr' => $usersByMonth[4] ?? 0,
            'nbUsersMay' => $usersByMonth[5] ?? 0,
            'nbUsersJun' => $usersByMonth[6] ?? 0,
            'nbUsersJul' => $usersByMonth[7] ?? 0,
            'nbUsersAug' => $usersByMonth[8] ?? 0,
            'nbUsersSep' => $usersByMonth[9] ?? 0,
            'nbUsersOct' => $usersByMonth[10] ?? 0,
            'nbUsersNov' => $usersByMonth[11] ?? 0,
            'nbUsersDec' => $usersByMonth[12] ?? 0,
        ]);
    }
    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Classes', 'fa fa-graduation-cap', Classe::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Events', 'fa fa-calendar', Event::class);
        yield MenuItem::linkToCrud('Places', 'fa fa-map-marker', Place::class);
        yield MenuItem::linkToCrud('Students', 'fa fa-user-graduate', Student::class);
    }
}
