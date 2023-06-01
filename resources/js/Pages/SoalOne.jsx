import { Head, Link } from '@inertiajs/react';

const SoalOne = (props) => {
    return (
        <>
            <div className="flex justify-center w-full h-screen overscroll-none bg-[url('/assets/test-background2.jpg')] bg-cover text-white text-1sm overscroll-auto bg-contain">

                <div className="card">
                    {props.nilai}
                </div>


            </div>
        </>
    )
}

export default SoalOne
