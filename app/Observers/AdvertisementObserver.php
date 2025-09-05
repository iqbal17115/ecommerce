<?php

namespace App\Observers;

use App\Models\Advertisement;

class AdvertisementObserver
{
    /**
     * Handle the Advertisement "created" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function created(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the Advertisement "updated" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function updated(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the Advertisement "deleted" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function deleted(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the Advertisement "restored" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function restored(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the Advertisement "force deleted" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function forceDeleted(Advertisement $advertisement)
    {
        //
    }
}
