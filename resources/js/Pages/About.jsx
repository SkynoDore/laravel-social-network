import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

export default function About({ auth}) {
    return (
        <>
            <Head title="About" />
<div className="d-flex flex-column justify-content-center text-center bg-light">
                    <Navbar auth={auth} />
                    <main className="mt-5 text-dark w-75 mx-auto">
                        <p>Esta es la página sobre mí</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam qui minima eaque pariatur hic deleniti fugit cumque, quia, quibusdam ab earum officia voluptas explicabo? Officiis repudiandae mollitia corrupti eligendi perspiciatis!</p>
                        <p>Asperiores omnis explicabo, sunt officia quia, quod laboriosam repellat dolorem repudiandae enim laudantium facilis laborum vel necessitatibus voluptatibus impedit sit animi nostrum! Neque quia minima facere animi culpa eaque eum!</p>
                        <p>Cumque delectus quam vero voluptatum voluptatibus ipsam repellat quasi libero ut omnis, dicta unde corporis nobis at, laboriosam quos sed accusantium eum! Iste aliquam porro totam magni amet placeat voluptate.</p>
                        <p>Cum incidunt fugiat adipisci consequuntur quis! Veritatis praesentium beatae, eligendi distinctio porro labore! Placeat vero quidem illum dolorum minima commodi eveniet delectus modi et. Labore sed et impedit nihil eum.</p>
                        <p>Officia eligendi corporis commodi, aperiam ea id sapiente consectetur fugit vel, itaque illo aut, labore eius natus doloremque repellendus consequuntur possimus aspernatur provident omnis unde? Error alias cumque deserunt. Praesentium.</p>
                        <img src="assets/img/1.jpg" alt="example"/>
                        <p>Consectetur obcaecati hic iusto quam, aspernatur corporis assumenda nobis consequatur ad architecto voluptas adipisci cupiditate doloribus iure accusantium dicta perferendis incidunt a perspiciatis quo molestias ratione veritatis debitis! Pariatur, voluptatibus!</p>
                    </main>

                    <Footer/>
                </div>
        </>
    );
}
