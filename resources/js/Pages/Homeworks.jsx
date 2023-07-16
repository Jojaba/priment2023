import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, Link } from '@inertiajs/react';

export default function Homeworks(props) {
    // console.log(props.homeworks);
    // Working on usefull props to display the news
    const homeworksArray = props.homeworks;
    const homeworksCount = homeworksArray.length;
    let homeworksItems = [];
    let addNewsButton = '';
    // looping through the homeworks
    for(let i=0; i<homeworksCount; i++) {
        let editLink = '';
        /*if(props.auth.user.identity == 'teacher' || props.auth.user.id == homeworksArray[i].author_id) {
            let HrefId = "/devoirs/"+homeworksArray[i].id+"/edit";
            homeworksItems.push(<article key={homeworksArray[i].id} id={homeworksArray[i].id} className={homeworksArray[i].state}><h3>{homeworksArray[i].title}</h3><p><Link href={HrefId}>Modifier</Link></p><p>Etat : {homeworksArray[i].state}</p><p>Date : {homeworksArray[i].date}</p><p>Heure : {homeworksArray[i].time}</p><p>{homeworksArray[i].content}</p></article>);
        } else {
            homeworksItems.push(<article key={homeworksArray[i].id} id={homeworksArray[i].id} className={homeworksArray[i].state}><h3>{homeworksArray[i].title}</h3><p>Etat : {homeworksArray[i].state}</p><p>Date : {homeworksArray[i].date}</p><p>Heure : {homeworksArray[i].time}</p><p>{homeworksArray[i].content}</p></article>);
        }*/
        if(props.auth.user.role >= 10 || props.auth.user.id == homeworksArray[i].author_id) {
            editLink = <div className="edit-link"><Link title="Modifier" href={"/devoirs/"+homeworksArray[i].id+"/edit"}>&#9998;</Link></div>;
        }
        homeworksItems.push(<article key={homeworksArray[i].id} id={"dev"+homeworksArray[i].id} className={homeworksArray[i].state}>{editLink}<h3><a href={"/devoirs/#dev"+homeworksArray[i].id}>#</a> Pour le {homeworksArray[i].date} à {homeworksArray[i].time}</h3><p className="el-content">{homeworksArray[i].content}</p><div className="el-infos">Mis à jour : {homeworksArray[i].updated_at} <span className="separator">&bull;</span> Classe : {homeworksArray[i].classroom} <span className="separator">&bull;</span> Auteur : {homeworksArray[i].author_display_name}</div></article>);
    };
    // Generating the Add Button to add new news
    if(props.auth.user.role >= 10) {
        addNewsButton = <div className="add-el"><Link href="/devoirs/create" title="Ajouter des devoirs">+</Link></div>;
    }
    return (
        <>
            <Head title="Prim'ENT - Devoirs" />
            <div className="homeworks-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="homeworksP" />
                    </div>
                </header>

                <main id="main" className="homeworks-listing">
                    {addNewsButton}
                    <h2>Prim'DEVOIRS</h2>
                        <div className="el-content">
                            {(homeworksArray) ?
                                <>                        
                                    {homeworksItems}
                                </>
                            :
                                <>
                                    <p>Aucun devoir à vous afficher ici&hellip;</p>
                                </>
                            }
                        </div>
                </main>

                <AppFooter />

            </div>
        </>
    );
}
